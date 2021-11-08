<div class="slider">
                    <!-- <div class="row row-sm">
                         <div class="slider-item col-md-6 col-sm">
                            <div class="slider-card">
                                <div class="slider-card__title">Mở bán hàng tuần</div>
                                <img class="slider-card__img" src='./assets/img/slider/slider1.jpg'/>
                                <div class="slider-card__list-product-ref">
                                    <div class="row">
                                        <a href="#" class="slider-card__product-item-ref col-3">
                                            <img class="slider-card__product-ref__img" src="./assets/img/slider/hinh1.gif" alt="ảnh">
                                        </a>
                                        <a href="#" class="slider-card__product-item-ref col-3">
                                            <img class="slider-card__product-ref__img" src="./assets/img/slider/hinh4.jpg" alt="ảnh">
                                        </a>
                                        <a href="#" class="slider-card__product-item-ref col-3">
                                            <img class="slider-card__product-ref__img" src="./assets/img/slider/hinh1.gif" alt="ảnh">
                                        </a>
                                        <a href="#" class="slider-card__product-item-ref col-3">
                                            <img class="slider-card__product-ref__img" src="./assets/img/slider/hinh2.gif" alt="ảnh">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slider-item col-md-6 col-sm">
                            <div class="slider-card">
                                <div class="slider-card__title">Mở bán hàng tuần</div>
                                <img class="slider-card__img" src='./assets/img/slider/slider2.jpg'/>
                                <div class="slider-card__list-product-ref">
                                    <div class="row">
                                        <a href="#" class="slider-card__product-item-ref col-3">
                                            <img class="slider-card__product-ref__img" src="./assets/img/slider/hinh3.gif" alt="ảnh">
                                        </a>
                                        <a href="#" class="slider-card__product-item-ref col-3">
                                            <img class="slider-card__product-ref__img" src="./assets/img/slider/hinh2.gif" alt="ảnh">
                                        </a>
                                        <a href="#" class="slider-card__product-item-ref col-3">
                                            <img class="slider-card__product-ref__img" src="./assets/img/slider/hinh1.gif" alt="ảnh">
                                        </a>
                                        <a href="#" class="slider-card__product-item-ref col-3">
                                            <img class="slider-card__product-ref__img" src="./assets/img/slider/hinh3.gif" alt="ảnh">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> 

                    </div> -->
                    <div class="slideshow-container">

                        <div class="mySlides">
                            <img src="./assets/img/background/sliderbg1.jpg" style="width:100%">
                        </div>
                        <div class="mySlides">
                            <img src="./assets/img/background/sliderbg2.jpg" style="width:100%">
                        </div>
                    </div>

                <script>
                    var slideIndex = 0;
                    showSlides();
                    function showSlides(){
                        var i;
                        var slides = document.getElementsByClassName("mySlides");
                        for(i=0;i<slides.length;i++){
                            slides[i].style.display = "none";
                        }
                        slideIndex++;
                        if(slideIndex > slides.length) {
                            slideIndex = 1;
                        }
                        slides[slideIndex-1].style.display="block";
                        setTimeout(showSlides,2500);
                    }
                    
                </script>
</div>
                