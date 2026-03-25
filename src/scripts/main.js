document.addEventListener('DOMContentLoaded', () => {
    // Add any initialization code here as needed
    // docking sticky menus
    (function () {
        const nav1 = document.querySelector('.nav-primary');
        const nav2 = document.querySelector('.nav-secondary');
        if (!nav1 || !nav2) return;

        let nav1H, nav2H, nav2NaturalTop, lastScrollY;
        let shim;

        function measure() {
            nav1.style.cssText = '';
            nav2.style.cssText = '';
            if (shim) shim.style.height = '0';

            nav1H            = nav1.offsetHeight;
            nav2H            = nav2.offsetHeight;
            nav2NaturalTop   = nav2.getBoundingClientRect().top + window.scrollY;
        }

        function update() {
            const scrollY  = window.scrollY;
            const goingUp  = scrollY < lastScrollY;
            lastScrollY    = scrollY;

            const pushStart = nav2NaturalTop - nav1H;

            if (scrollY <= pushStart) {
            // ── A: Both in normal flow ──────────────────────────────
            nav1.style.cssText = 'position:sticky;top:0;';
            nav2.style.cssText = '';
            shim.style.height  = '0';

            } else if (scrollY < nav2NaturalTop) {
            // ── B: Push zone — nav1 sliding out ────────────────────
            const push = scrollY - pushStart;
            nav1.style.cssText = `position:sticky;top:0;transform:translateY(-${push}px);`;
            nav2.style.cssText = '';
            shim.style.height  = '0';

            } else {
            // ── C/D: nav2 has fully taken over ─────────────────────
            shim.style.height        = nav2H + 'px';
            nav2.style.cssText       = `position:fixed;top:0;width:100%;z-index:200;`;

            if (goingUp) {
                // D: Both visible, stacked
                nav1.style.cssText     = `position:fixed;top:0;width:100%;z-index:100;`;
                nav2.style.top         = nav1H + 'px';
            } else {
                // C: nav1 hidden above, nav2 at top
                nav1.style.cssText     = `position:fixed;top:0;width:100%;z-index:100;transform:translateY(-${nav1H}px);pointer-events:none;`;
            }
            }
        }

        window.addEventListener('load', () => {
            shim = document.createElement('div');
            nav2.insertAdjacentElement('afterend', shim);
            measure();
            lastScrollY = window.scrollY;
            update();
        });

        window.addEventListener('scroll', update, { passive: true });
        window.addEventListener('resize', () => { measure(); lastScrollY = window.scrollY; update(); }, { passive: true });
    })();
});
