export function initLightbox() {    
    // Double-check modal exists
    const modal = document.getElementById('lightboxModal');
    if (!modal) {
      return false;
    }
    
    // Collect all images with the 'slide' class AND images inside figures with 'slide' class
    const directSlideImages = document.querySelectorAll('img.slide');
    const figureSlideImages = document.querySelectorAll('figure.slide img');
    
    // Combine both collections into one array
    const allSlides = [...directSlideImages, ...figureSlideImages];
    
    // Remove duplicates (in case an image has both)
    const slideImages = allSlides.filter((img, index, self) => 
      index === self.findIndex((t) => t.src === img.src)
    );
        
    if (slideImages.length === 0) {
      return true;
    }
  
    const lightboxImage = document.getElementById('lightboxImage');
    const imageTitle = document.getElementById('lightboxTitle');
    const closeBtn = document.getElementById('closeLightboxBtn');
    const prevBtn = document.getElementById('prevLightboxSlide');
    const nextBtn = document.getElementById('nextLightboxSlide');
    const counter = document.getElementById('lightboxCounter');
    const body = document.body;
  
    if (!lightboxImage) {
      return false;
    }
  
    let currentIndex = 0;
    let imageArray = [];
  
    // Build array of image sources and alts
    slideImages.forEach((img, index) => {
      // Get full-size image URL from data attribute or src
      let fullSizeUrl = img.dataset.fullSrc || img.src;
      
      // Try to get full size from WordPress srcset if available
      if (img.srcset) {
        const srcsetArray = img.srcset.split(',');
        const largestImage = srcsetArray[srcsetArray.length - 1].trim().split(' ')[0];
        fullSizeUrl = largestImage;
      }
      
      // Try to extract full size from WordPress URL patterns
      // WordPress usually has -150x150, -300x200, etc. in thumbnails
      fullSizeUrl = fullSizeUrl.replace(/-\d+x\d+(\.[a-z]+)$/i, '$1');
      
      imageArray.push({
        src: fullSizeUrl,
        alt: img.alt || '',
        title: img.title || img.alt || 'Image ' + (index + 1)
      });
  
      // Make images clickable
      img.style.cursor = 'pointer';
      
      // Add click handler to the image
      img.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        openLightbox(index);
      });
  
      // Also add click handler to parent figure if it exists
      const parentFigure = img.closest('figure.slide');
      if (parentFigure) {
        parentFigure.style.cursor = 'pointer';
      }
    });
  
    function openLightbox(index) {
      currentIndex = index;
      
      // Add fade-in class
      lightboxImage.style.opacity = '0';
      
      showImage();
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      body.classList.add('overflow-hidden');
    }
  
    function closeLightbox() {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      body.classList.remove('overflow-hidden');
    }
  
    function showImage() {
      if (imageArray.length > 0 && lightboxImage) {        
        // Fade out
        lightboxImage.style.opacity = '0';
        
        // Wait for fade out, then change image
        setTimeout(() => {
          lightboxImage.src = imageArray[currentIndex].src;
          lightboxImage.alt = imageArray[currentIndex].alt;
          
          // Update title
          if (imageTitle) {
            imageTitle.textContent = imageArray[currentIndex].title;
          }
          
          updateCounter();
          
          // Fade in
          setTimeout(() => {
            lightboxImage.style.opacity = '1';
          }, 50);
        }, 300);
      }
    }
  
    function updateCounter() {
      if (counter && imageArray.length > 1) {
        counter.textContent = `${currentIndex + 1} / ${imageArray.length}`;
      }
    }
  
    function nextImage() {
      currentIndex = (currentIndex + 1) % imageArray.length;
      showImage();
    }
  
    function prevImage() {
      currentIndex = (currentIndex - 1 + imageArray.length) % imageArray.length;
      showImage();
    }
  
    // Event listeners
    if (closeBtn) {
      closeBtn.addEventListener('click', closeLightbox);
    }
  
    if (nextBtn) {
      nextBtn.addEventListener('click', nextImage);
    }
  
    if (prevBtn) {
      prevBtn.addEventListener('click', prevImage);
    }
  
    // Close on background click
    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        closeLightbox();
      }
    });
  
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
      if (!modal.classList.contains('hidden')) {
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowRight') nextImage();
        if (e.key === 'ArrowLeft') prevImage();
      }
    });
  
    // Hide navigation buttons if only one image
    if (imageArray.length <= 1) {
      if (prevBtn) prevBtn.style.display = 'none';
      if (nextBtn) nextBtn.style.display = 'none';
    }
    
    // Add transition styles to image
    lightboxImage.style.transition = 'opacity 0.3s ease-in-out';
    return true;
  }
