(function(){
  const slides = Array.from(document.querySelectorAll('.timeline-slide'));
  if(slides.length===0) return;
  const points = Array.from(document.querySelectorAll('.timeline-point'));
  const progress = document.querySelector('.timeline-progress');
  const prev = document.querySelector('.prev-btn');
  const next = document.querySelector('.next-btn');

  let index = slides.findIndex(s=>s.classList.contains('active'));
  if(index<0) index = 0;

  function render(){
    slides.forEach((s,i)=>{
      s.style.display = i===index ? 'block' : 'none';
    });
    points.forEach((p,i)=>p.classList.toggle('active', i===index));
    if(progress){
      const pct = index/(slides.length-1);
      progress.style.width = `${pct*100}%`;
      progress.style.background = 'var(--primary-color)';
    }
    if(window.feather){ feather.replace(); }
  }

  prev && prev.addEventListener('click',()=>{
    index = (index - 1 + slides.length) % slides.length;
    render();
  });

  next && next.addEventListener('click',()=>{
    index = (index + 1) % slides.length;
    render();
  });

  points.forEach((p,i)=>p.addEventListener('click',()=>{ index=i; render(); }));

  document.addEventListener('DOMContentLoaded',()=>{
    if(window.AOS){ AOS.init(); }
  });

  render();
})();
