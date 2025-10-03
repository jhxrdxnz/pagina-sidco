(function(){
  const track = document.getElementById('cycleCarousel');
  if(!track) return;
  const prevBtn = document.getElementById('cyclePrevBtn');
  const nextBtn = document.getElementById('cycleNextBtn');
  const indicators = Array.from(document.querySelectorAll('.horizontal-indicator'));

  let activeIndex = 0;
  const items = Array.from(track.querySelectorAll('.cycle-item'));

  function updateView(){
    items.forEach((el,i)=>{
      el.classList.remove('cycle-item-prev','cycle-item-active','cycle-item-next');
    });
    const total = items.length;
    const prev = (activeIndex-1+total)%total;
    const next = (activeIndex+1)%total;
    items[prev].classList.add('cycle-item-prev');
    items[activeIndex].classList.add('cycle-item-active');
    items[next].classList.add('cycle-item-next');
    indicators.forEach((dot,i)=>{
      dot.classList.toggle('active', i===activeIndex);
    });
  }

  prevBtn && prevBtn.addEventListener('click',()=>{
    activeIndex = (activeIndex-1+items.length)%items.length;
    updateView();
  });
  nextBtn && nextBtn.addEventListener('click',()=>{
    activeIndex = (activeIndex+1)%items.length;
    updateView();
  });

  indicators.forEach(dot=>{
    dot.addEventListener('click',()=>{
      const slide = Number(dot.getAttribute('data-slide'))||0;
      activeIndex = slide;
      updateView();
    });
  });

  updateView();
})();
