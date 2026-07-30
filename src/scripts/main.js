// main.js
// console.log('script loaded');
// alert('with magic');
const originalDispatchEvent = EventTarget.prototype.dispatchEvent;
EventTarget.prototype.dispatchEvent = function(event) {
    if (event.type === 'wc-blocks_added_to_cart') {
        console.log('intercepted');
        document.querySelector('.wc-block-mini-cart__button')?.click();
    }
    originalDispatchEvent.call(this, event);
};