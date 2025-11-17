/**
 * Testimonials Slider
 * Converts stacked quote blocks into a slider on the frontend
 * Uses existing .slide-left and .slide-right buttons from the testimonails pattern
 */

export function initTestimonialsSlider() {
    // Find testimonial sections using the actual class
    const testimonialSections = document.querySelectorAll('.allset-testimonials .wp-block-column[style*="66.66%"]');
    
    console.log('Found sections:', testimonialSections.length);
    
    testimonialSections.forEach(section => {
      // Get ALL quotes in the section (whether from query block or manual)
      const quotes = section.querySelectorAll('.wp-block-quote');
      
      console.log('Found quotes in section:', quotes.length);
      
      // Only initialize if there are quotes
      if (quotes.length === 0) return;
      
      // Find the existing slider control buttons
      const sliderControls = section.querySelector('.slider-controls');
      
      console.log('Slider controls found:', sliderControls);
      
      // Hide controls if there's only one quote
      if (quotes.length <= 1) {
        console.log('Only one quote, hiding controls');
        if (sliderControls) {
          sliderControls.style.display = 'none';
        }
        return; // Exit early - no slider functionality needed
      }
      
      console.log('Multiple quotes, showing controls');
      
      // Show controls if hidden (for multiple quotes)
      if (sliderControls) {
        sliderControls.style.display = '';
      }
      
      const prevButton = section.querySelector('.slide-left .wp-block-button__link');
      const nextButton = section.querySelector('.slide-right .wp-block-button__link');
      
      // Create slider wrapper
      const sliderWrapper = document.createElement('div');
      sliderWrapper.className = 'testimonial-slider-wrapper';
      
      const sliderTrack = document.createElement('div');
      sliderTrack.className = 'testimonial-slider-track';
      
      // Move quotes into slider track
      quotes.forEach((quote, index) => {
        quote.classList.add('testimonial-slide');
        if (index === 0) quote.classList.add('active');
        sliderTrack.appendChild(quote.cloneNode(true));
      });
      
      // Remove the entire query block (which contains the list) if it exists
      const queryBlock = section.querySelector('.wp-block-query');
      if (queryBlock) {
        queryBlock.remove();
      } else {
        // If no query block, remove the original quotes (they were manually inserted)
        quotes.forEach(quote => quote.remove());
      }
      
      // Add slider track to wrapper and insert before controls
      sliderWrapper.appendChild(sliderTrack);
      
      if (sliderControls) {
        section.insertBefore(sliderWrapper, sliderControls);
      } else {
        section.appendChild(sliderWrapper);
      }
      
      // Slider state
      let currentSlide = 0;
      const slides = sliderTrack.querySelectorAll('.testimonial-slide');
      const totalSlides = slides.length;
      
      // Update slide position
      function updateSlider() {
        slides.forEach((slide, index) => {
          slide.classList.remove('active');
          if (index === currentSlide) {
            slide.classList.add('active');
          }
        });
        
        sliderTrack.style.transform = `translateX(-${currentSlide * 100}%)`;
      }
      
      // Next slide
      function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlider();
      }
      
      // Previous slide
      function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlider();
      }
      
      // Event listeners for existing buttons
      if (prevButton) {
        prevButton.addEventListener('click', (e) => {
          e.preventDefault();
          prevSlide();
        });
        prevButton.style.cursor = 'pointer';
      }
      
      if (nextButton) {
        nextButton.addEventListener('click', (e) => {
          e.preventDefault();
          nextSlide();
        });
        nextButton.style.cursor = 'pointer';
      }
      
      // Keyboard navigation on the slider wrapper
      sliderWrapper.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowLeft') prevSlide();
        if (e.key === 'ArrowRight') nextSlide();
      });
      
      // Make slider wrapper focusable for keyboard navigation
      sliderWrapper.setAttribute('tabindex', '0');
    });
}
