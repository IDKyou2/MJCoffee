function setActiveLink() {
    const links = document.querySelectorAll('.nav-link');
    links.forEach(link => {
      if (link.href === window.location.href) {
        link.classList.add('active');
      } else {
        link.classList.remove('active');
      }
    });
  }
  
  // Call the function when the page is loaded
  setActiveLink();
  
  // Call the function when a new link is clicked
  document.addEventListener('click', setActiveLink);
    