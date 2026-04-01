document.addEventListener('DOMContentLoaded', () => {
    // Add any initialization code here as needed
    // docking sticky menus
(function () {
  const nav1 = document.querySelector('.nav-primary');
  const nav1Inner = document.querySelector('.nav-primary-inner');
  const nav2 = document.querySelector('.nav-secondary');
  const curtain = document.querySelector('.primary-curtain');
  if (!nav1 || !nav1Inner || !nav2) return;

  let nav1H, nav2NaturalTop, lastScrollY, shim, trigger;
  let offset = 0;
  let targetOffset = 0;
  let rafId, snapTimer;
  const LERP = 0.18;

  function setup() {
    shim = document.createElement('div');
    nav1.insertAdjacentElement('afterend', shim);
  }

  function measure() {
    nav1Inner.style.transform = '';
    nav1.style.top = '0';
    nav1H = nav1.offsetHeight;
    shim.style.height = nav1H + 'px';
    nav2NaturalTop = nav2.getBoundingClientRect().top + window.scrollY;
    trigger = nav2NaturalTop - nav1H;
  }

  function applyStyles() {
    nav1.style.top = `-${offset}px`;
    nav1Inner.style.transform = `translateY(-${offset}px)`;
    nav2.style.top = `${nav1H - offset}px`;
    if (curtain) {
      const approach = Math.min(Math.max(window.scrollY / trigger, 0), 1);
      curtain.style.transform = `translateY(${nav1H - offset}px)`;
      curtain.style.height = `${50 + approach * 50}px`;
    }
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
      targetOffset = offset < nav1H / 2 ? 0 : nav1H;
      cancelAnimationFrame(rafId);
      rafId = requestAnimationFrame(animate);
    }, 100);
  }

  function update() {
    const scrollY = window.scrollY;
    const delta   = lastScrollY - scrollY;
    lastScrollY   = scrollY;

    if (scrollY <= trigger) {
      targetOffset = 0;
      nav1.style.top = '0';
      if (curtain) {
        const approach = Math.min(Math.max(scrollY / trigger, 0), 1);
        curtain.style.transform = `translateY(${nav1H}px)`;
        curtain.style.height = `${50 + approach * 50}px`;
      }
      return;
    }

    targetOffset = Math.min(Math.max(targetOffset - delta, 0), nav1H);
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

  window._dockingUpdate = update;
  window.addEventListener('scroll', update, { passive: true });
  window.addEventListener('resize', () => {
    measure();
    lastScrollY = window.scrollY;
    update();
  }, { passive: true });
})();

document.addEventListener('wpcf7mailsent', function (event) {
  var wrapper = event.target.closest('.wpcf7');
  var output = wrapper.querySelector('.wpcf7-response-output');
  output.innerHTML = '<h2>Thanks for sending a message.</h2><p>I\'ll be in touch soon.</p>';
  wrapper.classList.add('sent');
}, false);


});
