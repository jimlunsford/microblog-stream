document.addEventListener('DOMContentLoaded', function () {
  // Make each micro post card clickable
  function wireMicroPostCard(card) {
    if (!card || card.dataset.wired === '1') {
      return;
    }

    card.addEventListener('click', function (e) {
      var target = e.target;

      // Ignore clicks on links or form controls
      while (target && target !== card) {
        var tag = target.tagName;
        if (
          tag === 'A' ||
          tag === 'BUTTON' ||
          tag === 'INPUT' ||
          tag === 'TEXTAREA' ||
          tag === 'SELECT' ||
          tag === 'LABEL'
        ) {
          return;
        }
        target = target.parentElement;
      }

      var url = card.getAttribute('data-permalink');
      if (url) {
        window.location.href = url;
      }
    });

    card.dataset.wired = '1';
  }

  // Wire existing cards
  var cards = document.querySelectorAll('.micro-post');
  cards.forEach(function (card) {
    wireMicroPostCard(card);
  });

  // Load more posts on the same page
  var loadMoreLink = document.querySelector(
    '.pagination-load-more .pagination-older a'
  );
  var timeline = document.querySelector('.timeline');

  if (loadMoreLink && timeline) {
    var isLoading = false;
    var originalLabel = loadMoreLink.textContent;
    // Cache the pagination container so we know where to insert new posts
    var paginationContainer = loadMoreLink.closest('.pagination-load-more');

    loadMoreLink.addEventListener('click', function (e) {
      e.preventDefault();

      if (isLoading) {
        return;
      }

      var url = loadMoreLink.getAttribute('href');
      if (!url) {
        return;
      }

      isLoading = true;
      loadMoreLink.textContent =
        typeof microblogStreamL10n !== 'undefined'
          ? microblogStreamL10n.loading
          : 'Loading...';

      fetch(url, { credentials: 'same-origin' })
        .then(function (response) {
          return response.text();
        })
        .then(function (html) {
          var parser = new DOMParser();
          var doc = parser.parseFromString(html, 'text/html');

          // New posts from the next page
          var newPosts = doc.querySelectorAll('.timeline .micro-post');

          if (newPosts.length === 0) {
            loadMoreLink.textContent =
              typeof microblogStreamL10n !== 'undefined'
                ? microblogStreamL10n.noMorePosts
                : 'No more posts';
            loadMoreLink.classList.add('is-disabled');
            loadMoreLink.removeAttribute('href');
            return;
          }

          newPosts.forEach(function (post) {
            // Decide where to insert: before the pagination block if it sits inside .timeline
            if (paginationContainer && timeline.contains(paginationContainer)) {
              timeline.insertBefore(post, paginationContainer);
            } else {
              // Fallback, just append at the end
              timeline.appendChild(post);
            }
            wireMicroPostCard(post);
          });

          // Update the href to the next page if it exists
          var newMoreLink = doc.querySelector(
            '.pagination-load-more .pagination-older a'
          );

          if (newMoreLink && newMoreLink.getAttribute('href')) {
            loadMoreLink.setAttribute(
              'href',
              newMoreLink.getAttribute('href')
            );
            loadMoreLink.textContent = originalLabel;
          } else {
            loadMoreLink.textContent =
              typeof microblogStreamL10n !== 'undefined'
                ? microblogStreamL10n.noMorePosts
                : 'No more posts';
            loadMoreLink.classList.add('is-disabled');
            loadMoreLink.removeAttribute('href');
          }
        })
        .catch(function () {
          // On error, revert label so user can try again
          loadMoreLink.textContent = originalLabel;
        })
        .finally(function () {
          isLoading = false;
        });
    });
  }

  // Like label formatter
  function formatLikeLabel(count) {
    var singular =
      typeof microblogStreamL10n !== 'undefined' &&
      microblogStreamL10n.likeSingular
        ? microblogStreamL10n.likeSingular
        : '%s like';
    var plural =
      typeof microblogStreamL10n !== 'undefined' &&
      microblogStreamL10n.likePlural
        ? microblogStreamL10n.likePlural
        : '%s likes';

    var template = count === 1 ? singular : plural;
    return template.replace('%s', count);
  }

  // Likes, using event delegation so it works on loaded posts too
  document.addEventListener('click', function (event) {
    var target = event.target;
    if (!target || !target.closest) {
      return;
    }

    var button = target.closest('.micro-like-button');
    if (!button) {
      return;
    }

    event.preventDefault();
    event.stopPropagation();

    var postId = button.getAttribute('data-post-id');
    if (!postId) {
      return;
    }

    var storageKey = 'microblog_like_' + postId;

    try {
      if (window.localStorage && localStorage.getItem(storageKey) === '1') {
        return;
      }
    } catch (e) {
      // Ignore storage errors
    }

    var labelEl = button.querySelector('.micro-like-text');
    var currentCount = 0;

    if (labelEl && labelEl.textContent) {
      var match = labelEl.textContent.match(/(\d+)/);
      if (match && match[1]) {
        currentCount = parseInt(match[1], 10);
        if (isNaN(currentCount)) {
          currentCount = 0;
        }
      }
    }

    var newCount = currentCount + 1;

    if (labelEl) {
      labelEl.textContent = formatLikeLabel(newCount);
    }

    button.setAttribute('aria-pressed', 'true');
    button.classList.add('is-liked');

    try {
      if (window.localStorage) {
        localStorage.setItem(storageKey, '1');
      }
    } catch (e) {
      // Ignore storage errors
    }

    if (
      typeof microblogStreamL10n === 'undefined' ||
      !microblogStreamL10n.ajaxUrl ||
      !microblogStreamL10n.likeNonce
    ) {
      return;
    }

    var formData = new FormData();
    formData.append('action', 'microblog_stream_like');
    formData.append('post_id', postId);
    formData.append('nonce', microblogStreamL10n.likeNonce);

    fetch(microblogStreamL10n.ajaxUrl, {
      method: 'POST',
      credentials: 'same-origin',
      body: formData,
    })
      .then(function (response) {
        return response.json();
      })
      .then(function (data) {
        if (!data || !data.success || !data.data) {
          return;
        }

        var count = parseInt(data.data.count, 10);
        if (isNaN(count)) {
          return;
        }

        if (labelEl && data.data.label) {
          labelEl.textContent = data.data.label;
        } else if (labelEl) {
          labelEl.textContent = formatLikeLabel(count);
        }
      })
      .catch(function () {
        // Silent fail, optimistic UI already updated
      });
  });

  // Hamburger nav toggle
  var navToggle = document.querySelector('.site-nav-toggle');
  var siteNav = document.getElementById('site-primary-nav');

  if (navToggle && siteNav) {
    navToggle.addEventListener('click', function (e) {
      e.stopPropagation();

      var isOpen = siteNav.classList.toggle('is-open');
      navToggle.classList.toggle('is-active', isOpen);
      navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    // Close menu when clicking outside
    document.addEventListener('click', function (e) {
      if (!siteNav.classList.contains('is-open')) {
        return;
      }

      if (navToggle.contains(e.target) || siteNav.contains(e.target)) {
        return;
      }

      siteNav.classList.remove('is-open');
      navToggle.classList.remove('is-active');
      navToggle.setAttribute('aria-expanded', 'false');
    });
  }
});