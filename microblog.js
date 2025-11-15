document.addEventListener('DOMContentLoaded', function () {
  // Only make cards clickable on list views (home, blog, archive).
  var cards = document.querySelectorAll(
    'body.home .micro-post[data-permalink], ' +
    'body.blog .micro-post[data-permalink], ' +
    'body.archive .micro-post[data-permalink]'
  );

  cards.forEach(function (card) {
    card.addEventListener('click', function (e) {
      var target = e.target;

      // Ignore clicks on links or form controls.
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
  });
});