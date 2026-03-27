/* =============================================================
   Campus Selection Page — JavaScript
   ============================================================= */

document.addEventListener('DOMContentLoaded', function () {

    var selectorCards = document.querySelectorAll('.cmp-selector-card');
    var panels        = document.querySelectorAll('.cmp-panel');

    if ( ! selectorCards.length ) return;

    /* Switch campus */
    function switchCampus( campusId ) {
        /* Update selector cards */
        selectorCards.forEach(function (card) {
            var isActive = card.dataset.campus === campusId;
            card.classList.toggle('active', isActive);
            card.setAttribute('aria-selected', isActive ? 'true' : 'false');
            card.setAttribute('tabindex', isActive ? '0' : '-1');
        });

        /* Update panels */
        panels.forEach(function (panel) {
            var isActive = panel.id === 'cmp-panel-' + campusId;
            panel.classList.toggle('active', isActive);
        });
    }

    /* Click handler */
    selectorCards.forEach(function (card) {
        card.addEventListener('click', function () {
            switchCampus( this.dataset.campus );
        });

        /* Keyboard: Enter / Space */
        card.addEventListener('keydown', function (e) {
            if ( e.key === 'Enter' || e.key === ' ' ) {
                e.preventDefault();
                switchCampus( this.dataset.campus );
            }
        });
    });

});
