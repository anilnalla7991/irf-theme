/**
 * Results Page — Dedicated JavaScript
 * =====================================
 * Handles:
 *   - Year tab filtering
 *   - Exam chip filtering
 *   - "Show More" pagination (loads PAGE_SIZE cards at a time)
 *   - Counter animations (.counter elements)
 *
 * Enqueued in: functions.php → irf_enqueue_scripts() (results page only)
 * Depends on:  main.js (banner slider, IntersectionObserver reveal)
 */

(function () {
    'use strict';

    /* ── Config ──────────────────────────────────────────────── */
    var PAGE_SIZE = 12; // cards shown initially & loaded per "Show More" click


    /* ── Apply initial card limit to a grid ──────────────────── */
    function applyLimit(gridId, btnId) {
        var grid = document.getElementById(gridId);
        var btn  = document.getElementById(btnId);
        if (!grid) return;

        var visibleCount = 0;
        var cards = Array.from(grid.querySelectorAll('.rcard'));

        cards.forEach(function (card) {
            if (card.classList.contains('rcard-hidden')) return; // already filtered out
            visibleCount++;
            if (visibleCount > PAGE_SIZE) {
                card.classList.add('rcard-overlimit');
            } else {
                card.classList.remove('rcard-overlimit');
            }
        });

        // Hide the button when all visible cards fit within PAGE_SIZE
        if (btn) btn.classList.toggle('hidden', visibleCount <= PAGE_SIZE);
    }


    /* ── Show More / Show Less toggle ───────────────────────────── */
    window.showMoreCards = function (gridId, btnId) {
        var grid = document.getElementById(gridId);
        var btn  = document.getElementById(btnId);
        if (!grid || !btn) return;

        // If currently in "show less" mode, collapse back
        if (btn.dataset.mode === 'less') {
            applyLimit(grid);
            btn.dataset.mode = 'more';
            btn.innerHTML = 'Show More &nbsp;&#8595;';
            grid.closest('.section').scrollIntoView({ behavior: 'smooth', block: 'start' });
            return;
        }

        // Show More: reveal next PAGE_SIZE overlimit cards
        var overlimit = grid.querySelectorAll('.rcard-overlimit');
        var shown = 0;
        overlimit.forEach(function (card) {
            if (shown < PAGE_SIZE) {
                card.classList.remove('rcard-overlimit');
                shown++;
            }
        });

        // All shown → switch to "Show Less"
        if (grid.querySelectorAll('.rcard-overlimit').length === 0) {
            btn.dataset.mode = 'less';
            btn.innerHTML = 'Show Less &nbsp;&#8593;';
        }
    };


    /* ── Filter a grid by a data attribute value ─────────────── */
    function filterGrid(gridId, noMsgId, btnId, filterAttr, value) {
        var grid  = document.getElementById(gridId);
        var noMsg = document.getElementById(noMsgId);
        if (!grid) return;

        var visibleCount = 0;
        var cards = grid.querySelectorAll('.rcard');

        cards.forEach(function (card) {
            // Reset overlimit so applyLimit recalculates cleanly
            card.classList.remove('rcard-overlimit');

            var matches = (value === 'all' || card.dataset[filterAttr] === value);
            card.classList.toggle('rcard-hidden', !matches);
            if (matches) visibleCount++;
        });

        if (noMsg) noMsg.style.display = visibleCount === 0 ? 'block' : 'none';

        // Re-apply page limit on the filtered set
        applyLimit(gridId, btnId);
    }


    /* ── Year tabs ───────────────────────────────────────────── */
    document.querySelectorAll('.yr-tab').forEach(function (btn) {
        btn.addEventListener('click', function () {
            // Deactivate all tabs
            document.querySelectorAll('.yr-tab').forEach(function (b) {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });
            // Activate clicked tab
            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');

            filterGrid('yearGrid', 'yearNoResults', 'yearShowMore', 'year', this.dataset.year);
        });
    });


    /* ── Exam chips ──────────────────────────────────────────── */
    document.querySelectorAll('.exam-chip').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.exam-chip').forEach(function (b) {
                b.classList.remove('active');
            });
            this.classList.add('active');

            filterGrid('examGrid', 'examNoResults', 'examShowMore', 'exam', this.dataset.exam);
        });
    });


    /* ── Initialise limits on DOMContentLoaded ───────────────── */
    applyLimit('yearGrid', 'yearShowMore');
    applyLimit('examGrid', 'examShowMore');

}());
