$(document).ready(function(){
   $("#categorySearchBtn").click(function(){
      console.log("handle search.")      
   });

   const checkboxes = [...document.querySelectorAll('.form-check-input')];
   const brandListHolder = document.getElementById('brandList');
   checkboxes.forEach(item => {
      item.addEventListener('click', (e) => {
         e.stopImmediatePropagation();
         if(!item.checked){
            var list = brandListHolder.value.split(',');
            list = list.filter(it => it != item.getAttribute("value"))
            brandListHolder.value = list;
            console.log("Removing from hidden list holder.")
         }
         else{   
            console.log("Adding to hidden list holder.")
            if(brandListHolder.value.length > 0) {
               brandListHolder.value += ',' + item.getAttribute("value")
            }else{
               brandListHolder.value += item.getAttribute("value")
            }
         }
      })
   })

   const closers = [...document.querySelectorAll('.prevPicCloser')];
   picList = document.getElementById('picList');
   picDelList = document.getElementById('picDelList');
   closers.forEach((item, i) => {
         item.addEventListener('click', (e) => {
            e.preventDefault();
            
            
            console.log(item.getAttribute("data-picture"))
            removeFromPicList(item.getAttribute("data-picture"));
            item.parentElement.style.display = "none"
            
            picDelList.value += ',' + item.getAttribute("data-picture")
         })
   })

   function removeFromPicList(imagePath) {
      var curList = picList.value.split(",");
      curList = curList.filter(e => e !== imagePath);
      picList.value = curList;
   }


   // $.ajaxSetup({
   //    headers: {
   //        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   //    }
   // });
   //console.log($('meta[name="csrf-token"]').attr('content'));

   window.openEditWindow = function openEditWindow() {
      document.getElementById("adminPopup").classList.toggle('hidden');
   }

   window.closePopup = function closePopup() {
      document.getElementById("adminPopup").classList.toggle('hidden');
      console.log(document.getElementById("adminPopup").style.display);
   }

   window.searchIn = function searchIn(){
      console.log("HERE");
   }

   window.editRecordPopup = function deleteRecordPopup(){
      console.log("HERE2");
   }

   window.deleteRecordPopup = function deleteRecordPopup(id, table){
      // var token = $('meta[name="csrf-token"]').attr('content');
      // $.ajax({
      //    type: 'POST',
      //    url:"/adminPanel/deleteCategory",
      //    dataType: 'json',
      //    cache: false,
      //    beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
      //    data:{
      //       _token: token, 
      //       recordId:id
      //    },
      //    success:function(data){
      //       alert(data.success);
      //    },
      //    error: function(error) {
      //       console.log(error);
      //    }
      // });
   }

   window.showPhone = function(elem) {
      console.log("HGI")
      var holder = document.getElementById("phoneData");
      //console.log(holder.childNodes);
      var input = holder.childNodes[1];
      var display = holder.childNodes[3];

      //console.log(input)
      //console.log(display)

      input.classList.remove("hidden")
      display.classList.add("hidden")

      elem.parentNode.childNodes[3].classList.remove("hidden")
      elem.classList.add("hidden")
   }

   window.showEmail = function(elem) {
      var holder = document.getElementById("emailData");
      var input = holder.childNodes[1];
      var display = holder.childNodes[3];

      input.classList.remove("hidden")
      display.classList.add("hidden")

      elem.parentNode.childNodes[3].classList.remove("hidden")
      elem.classList.add("hidden")
   }

   window.showPassword = function(elem) {
      var holder = document.getElementById("passwordData");
      var input = holder.childNodes[1];
      var display = holder.childNodes[3];

      input.classList.remove("hidden")
      display.classList.add("hidden")

      elem.parentNode.childNodes[3].classList.remove("hidden")
      elem.classList.add("hidden")
   }
});

window.saveData = function saveData(formName){
   //let form = document.getElementById(formName+"Data");
   //TODO do settings
}


//basic idea FROM https://codepen.io/ChrisSargent/pen/meMMye with modifications
if ((window.location.href.indexOf("/products") > -1 || window.location.href.indexOf("/category") > -1) && window.location.href.indexOf('/adminPanel') < 0){
   var lowerTextField = document.querySelector("#lowerMoneyBound"),
   upperTextField = document.querySelector("#upperMoneyBound");
   
   var lowerSlider = document.querySelector('#lowerMoneyFilterRange'),
   upperSlider = document.querySelector('#upperMoneyFilterRange'),
   lowerVal = parseInt(lowerSlider.value);
   upperVal = parseInt(upperSlider.value);


   upperSlider.oninput = function() {
      lowerVal = parseInt(lowerSlider.value);
      upperVal = parseInt(upperSlider.value);
      
      if (upperVal < lowerVal + 4) {
         lowerSlider.value = upperVal - 4;
         
         if (lowerVal == lowerSlider.min) {
            upperSlider.value = 4;
         }
      }
      lowerTextField.value = lowerVal;
      upperTextField.value = upperVal;
   };
   
   
   lowerSlider.oninput = function() {
      lowerVal = parseInt(lowerSlider.value);
      upperVal = parseInt(upperSlider.value);
      
      if (lowerVal > upperVal - 4) {
         upperSlider.value = lowerVal + 4;
         
         if (upperVal == upperSlider.max) {
            lowerSlider.value = parseInt(upperSlider.max) - 4;
         }
         
      }
      lowerTextField.value = lowerVal;
      upperTextField.value = upperVal;
   };
   
   lowerTextField.oninput = function(){
      lowerSlider.value = parseInt(lowerTextField.value);
   }
   
   upperTextField.oninput = function(){
      upperSlider.value = parseInt(upperTextField.value);
   }
}