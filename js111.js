 var n = localStorage.getItem('on_load_counter');
        
        if (n === null) {
           n = 0;
         }
         if (n === '300'){
             n--;
         }
         n++;
        
         localStorage.setItem("on_load_counter", n);
        
         nums = n.toString().split('').map(Number);
         document.getElementById('CounterVisitor').innerHTML = 'Total number of visitors:';
         for (var i of nums) {
           document.getElementById('CounterVisitor').innerHTML += '<span class="counter-item">' + i + '</span>';
         }
        
/*var s=0;

setInterval(() => {
  s+=1;
  if(s==51)
    s-=1;
  document.getElementById('CounterVisitor').innerHTML = "Total number rented car = " + s;
  
},90);*/

var s1=0;

setInterval(() => {
  s1+=1;
  if(s1==11)
    s1-=1;
  document.getElementById('establish').innerHTML = "We have offered the service for " + s1 + " years!";
  
},200);



pname = ['pname1','pname2','pname3','pname4','pname5','pname6','pname7','pname8','pname9','pname10','pname11','pname12']
pday = ['pday1','pday2','pday3','pday4','pday5','pday6','pday7','pday8','pday9','pday10','pday11','pday12']
pdayt = ['pdayt1','pdayt2','pdayt3','pdayt4','pdayt5','pdayt6','pdayt7','pdayt8','pdayt9','pdayt10','pdayt11','pdayt12']
price = ['price1','price2','price3','price4','price5','price6','price7','price8','price9','price10','price11','price12']
iname = []
iday = []
iprice = []

function changeDateFormat(inputDate){  // expects Y-m-d
    var splitDate = inputDate.split('-');
    if(splitDate.count == 0){
        return null;
    }

    var year = splitDate[0];
    var month = splitDate[1];
    var day = splitDate[2]; 

    return month + '/' + day + '/' + year;
}

function parseDate(str) {
    var mdy = str.split('/');
    return new Date(mdy[2], mdy[0]-1, mdy[1]);
}

function datediff(first, second) {
    // Take the difference between the dates and divide by milliseconds per day.
    // Round to nearest whole number to deal with DST.
    return Math.round((second-first)/(1000*60*60*24));
}


function addItem(i){

    fday = changeDateFormat(document.getElementById(pday[i]).value);
    tday = changeDateFormat(document.getElementById(pdayt[i]).value);
    diffDays = datediff(parseDate(fday), parseDate(tday))
    iname.push(document.getElementById(pname[i]).innerText)
    iday.push(parseInt(diffDays+1))
    iprice.push(parseInt(document.getElementById(price[i]).innerText))
    // console.log(pname[i])
    displayCart()

}

function displayCart(){

    cartdata = '<table><tr><th>Product Name</th><th>Days</th><th>Price</th><th>Total</th></tr>';

    total = 0;

    for (i = 0; i<iname.length; i++){
        total += iday[i] * iprice[i]
        cartdata += "<tr><td>" + iname[i] + "</td><td>" + iday[i] + "</td><td>" + iprice[i] + "</td><td>" + iday[i]*iprice[i] + "</td><td><button onclick='delElement(" + i + ")'>Delete</button></td></tr>"
    }

    cartdata += '<tr><td></td><td></td><td></td><td>' + total + '</td></tr></table>'

    document.getElementById('cart').innerHTML = cartdata
}

function delElement(a){
    iname.splice(a, 1);
    iday.splice(a, 1)
    iprice.splice(a, 1)
    displayCart()
}

function gettab(){
    document.getElementById('cartre').innerHTML = document.getElementById('cart').innerHTML;
}
