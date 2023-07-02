import React from 'react'
import {Swiper, SwiperSlide} from "swiper/react"
import SwiperCore, { Navigation, Pagination, Autoplay } from 'swiper';
import "swiper/css";
import ImgOne from "../../assets/promo_img_one.png"
import ImgTwo from "../../assets/promo_img_two.png"
import ImgThree from "../../assets/promo_img_three.png"
import ImgFour from "../../assets/promo_img_four.png"

SwiperCore.use([Navigation, Pagination, Autoplay]);

function Advertise() {
  const promo_imgs = [ImgOne, ImgTwo, ImgThree, ImgFour]
  return (
    <div style={{borderRadius: "15px", width: "50%", paddingLeft:"10px"}}>
      <Swiper modules={[Pagination]} navigation pagination={{clickable: true}} autoplay={{delay: 3000}}>
        {promo_imgs.map((img,index) =>(
          <SwiperSlide key={index}>
            <img src={img} alt={`promo ${index + 1}`} style={{width: "100%", height: "350px"}} />
          </SwiperSlide>
        ))}
      </Swiper>
    </div>
  )
}

export default Advertise
