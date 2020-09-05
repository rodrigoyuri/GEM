const slidePage = document.querySelector(".slide-page");
const nextBtnFirst = document.querySelector(".firstNext");
const prevBtnSec = document.querySelector(".prev-1");
const nextBtnSec = document.querySelector(".next-1");
const prevBtnThird = document.querySelector(".prev-2");
const submitBtn = document.querySelector(".submit");


nextBtnFirst.addEventListener("click", function(){
    slidePage.style.marginLeft = "-25%";

  });
  nextBtnSec.addEventListener("click", function(){
    slidePage.style.marginLeft = "-50%";

  });

  submitBtn.addEventListener("click", function(){
  
    setTimeout(function(){
      alert("Usuario cadastrado");
      location.reload();
    },800);
  });
  
  prevBtnSec.addEventListener("click", function(){
    slidePage.style.marginLeft = "0%";
  });
  prevBtnThird.addEventListener("click", function(){
    slidePage.style.marginLeft = "-25%";
  });

  //select assistida volunario


  $(function () {
      $("#ddlPassport").change(function () {
          if ($(this).val() === "vol") {
              $("#voluntario").show();
              $("#assistida").hide();
          } else if ($(this).val() === "ass") {
              $("#assistida").show();
              $("#voluntario").hide();
          } else {
              $("#voluntario").hide();
              $("#assistida").hide();
              
          }
      });
  });