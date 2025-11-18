document.addEventListener('DOMContentLoaded', function () {
  // Helper to wire a single micro post card to be clickable.
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
          tag === 'SELECT'
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

    // Mark as wired so we do not attach twice.
    card.dataset.wired = '1';
  }

  // Wire existing cards on initial load.
  var cards = document.querySelectorAll('.micro-post');
  cards.forEach(function (card) {
    wireMicroPostCard(card);
  });

  // Load more on the same page
  var loadMoreLink = document.querySelector(
    '.pagination-load-more .pagination-older a'
  );
  var timeline = document.querySelector('.timeline');

  if (loadMoreLink && timeline) {
    var isLoading = false;

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
      var originalLabel = loadMoreLink.textContent;
      loadMoreLink.textContent = 'Loading...';

      fetch(url, { credentials: 'same-origin' })
        .then(function (response) {
          return response.text();
        })
        .then(function (html) {
          var parser = new DOMParser();
          var doc = parser.parseFromString(html, 'text/html');

          // Find new posts on the next page.
          var newPosts = doc.querySelectorAll('.timeline .micro-post');

          if (newPosts.length === 0) {
            loadMoreLink.textContent = 'No more posts';
            loadMoreLink.classList.add('is-disabled');
            loadMoreLink.removeAttribute('href');
            return;
          }

          newPosts.forEach(function (post) {
            // Append the card into the current timeline.
            timeline.appendChild(post);
            // Wire clickable behavior on the newly added card.
            wireMicroPostCard(post);
          });

          // Look for a new "Load more" link in the fetched page.
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
            // No more pages. Disable the button.
            loadMoreLink.textContent = 'No more posts';
            loadMoreLink.classList.add('is-disabled');
            loadMoreLink.removeAttribute('href');
          }
        })
        .catch(function () {
          // On error, revert label so user can try again.
          loadMoreLink.textContent = originalLabel;
        })
        .finally(function () {
          isLoading = false;
        });
    });
  }
});