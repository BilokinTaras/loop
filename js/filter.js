if(document.querySelector('.all')){
   let tabtovar = document.querySelector('.all .tovar');
   let tabprice = document.querySelector('.all .price');

   let tabtovarContent = document.querySelector('.all .filter__search');
   let tabpriceContent = document.querySelector('.all .filter__price');
   
   tabtovar.addEventListener('click', () => {
      tabtovarContent.classList.toggle('show');
   });

   tabprice.addEventListener('click', () => {
      tabpriceContent.classList.toggle('show');
   });
}