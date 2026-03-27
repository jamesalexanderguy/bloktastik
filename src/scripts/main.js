document.addEventListener('DOMContentLoaded', () => {
    // Add any initialization code here as needed
    // docking sticky menus
(function () {
  const nav1 = document.querySelector('.nav-primary');
  const nav2 = document.querySelector('.nav-secondary');
  if (!nav1 || !nav2) return;

  let nav1H, nav2NaturalTop, lastScrollY, shim;
  let offset = 0;
  let targetOffset = 0;
  let rafId, snapTimer;
  const LERP = 0.18; // 0–1, lower = smoother/slower

  function setup() {
    shim = document.createElement('div');
    nav1.insertAdjacentElement('afterend', shim);
  }

  function measure() {
    nav1.style.top = '0';
    nav1H = nav1.offsetHeight;
    shim.style.height = nav1H + 'px';
    nav2NaturalTop = nav2.getBoundingClientRect().top + window.scrollY;
  }

  function applyStyles() {
    nav1.style.top = `-${offset}px`;
    nav2.style.top = `${nav1H - offset}px`;
  }

  function animate() {
    const diff = targetOffset - offset;
    if (Math.abs(diff) < 0.5) {
      offset = targetOffset;
      applyStyles();
      return;
    }
    offset += diff * LERP;
    applyStyles();
    rafId = requestAnimationFrame(animate);
  }

  function scheduleSnap() {
    clearTimeout(snapTimer);
    snapTimer = setTimeout(() => {
      // snap to nearest boundary
      targetOffset = offset < nav1H / 2 ? 0 : nav1H;
      cancelAnimationFrame(rafId);
      rafId = requestAnimationFrame(animate);
    }, 100);
  }

  function update() {
    const scrollY = window.scrollY;
    const delta   = lastScrollY - scrollY;
    lastScrollY   = scrollY;

    const trigger = nav2NaturalTop - nav1H;

    if (scrollY <= trigger) {
      targetOffset = 0;
    } else {
      targetOffset = Math.min(Math.max(targetOffset - delta, 0), nav1H);
    }

    cancelAnimationFrame(rafId);
    rafId = requestAnimationFrame(animate);
    scheduleSnap();
  }

  window.addEventListener('load', () => {
    setup();
    measure();
    lastScrollY = window.scrollY;
    update();
  });

  window.addEventListener('scroll', update, { passive: true });
  window.addEventListener('resize', () => {
    measure();
    lastScrollY = window.scrollY;
    update();
  }, { passive: true });
})();
});
