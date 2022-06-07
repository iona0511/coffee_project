
const wrap = document.querySelector(".wrap");
const classIndexApi =
    "./class-index-api.php";
const deleteApi = "./delete-api.php";
const style = document.querySelector(".style");
const search = document.querySelector(".search");
const sort = document.querySelector("#sort");
const inputs = document.querySelector('.inputs')
const len = 6; //控制一頁筆幾
let choose = 0; //建立一個全域性變數用來儲存當前處於第幾個頁面


function priceAsc(a, b) {
    return a.course_price - b.course_price;
}
function priceDesc(a, b) {
    return b.course_price - a.course_price;
}
function levelAsc(a, b) {
    return a.course_level - b.course_level;
}
function levelDesc(a, b) {
    return b.course_level - a.course_level;
}

// 資料/畫面生成

function getData() {

    fetch(classIndexApi, {
        method: "POST",
       
    })
        .then((response) => {
            return response.json();
            
        })
        
        .then((data) => {
         
            localStorage.setItem("data", JSON.stringify(data));
            sort.addEventListener("change", function () {
                if (sort.value === "priceAsc") {
                    data.sort(priceAsc);
                } else if (sort.value === "priceDesc") {
                    data.sort(priceDesc);
                } else if (sort.value === "levelAsc") {
                    data.sort(levelAsc);
                } else if (sort.value === "levelDesc") {
                    data.sort(levelDesc);
                }
                content ()
            });
           


        function content (){
            wrap.innerHTML = ''
           
            for (let i = 0; i < data.length; i++) {
                const trs = document.createElement("tr");
                trs.dataset.index = data[i].course_name;
                trs.className = "trs";
                wrap.appendChild(trs);
                
                trs.innerHTML = `
                <td>${data[i].course_sid}</td>
                 <td scope="row" class="pic">
                <img src="../../images/29/${data[i].course_img_s}" alt="" />
            </td>
            <td>${data[i].course_name}</td>
            <td class="course_level">${data[i].course_level}</td>
            <td>NT$${data[i].course_price}</td>
            <td><a href="edit-data.html"><i class="fa-solid fa-pen-to-square" onclick="editDataA(${data[i].course_sid})"></i></a></td>
            <td><a href=""><i class="fa-solid fa-trash-can" onclick="deleteData(${data[i].course_sid})"></i></a></td>`;
             
        
                courseLevel =
                    document.querySelectorAll(".course_level");
                if (data[i].course_level === "1") {
                    courseLevel[i].innerHTML = "入門";
                }
                if (data[i].course_level === "2") {
                    courseLevel[i].innerHTML = "中級";
                }
                if (data[i].course_level === "3") {
                    courseLevel[i].innerHTML = "高級";
                }
            }
        }
    
         content();

        search.addEventListener("input", () => {
            if (search.value === "") {
                if (
                    (style.innerHTML +=
                        '.trs:not([data-index*="' +
                            search.value +
                            '"]){display:none;}' ===
                        true)
                ) {
                    style.innerHTML =
                        '.trs:not([data-index*="' +
                        search.value +
                        '"]){}';
                }
            }
            data.forEach(function (v, i) {
              
                ar2 = data[i].course_name.split("");
                


                ar2.forEach(function (v,i) {
                   
                    if (search.value === ar2[i])
                        style.innerHTML +=
                            '.trs:not([data-index*="' +
                            search.value +
                            '"]){display:none;}';
                });
            });
        });
       
        
        })
    
}

// if(window.location.href === "http://localhost/coffee-course/delete-data.html"){ }

getData();


    // function add(){
    //    getData(false);
    // }
    // add();

// 修改取得sid
function editDataA(value) {
    localStorage.setItem('sid',`${value}`);
}



// 資料刪除
function deleteData(value) {
    const fd = new FormData();
    fd.append("course_sid", value);
    confirm("確定要刪除第" + value + "筆資料嗎?")
        ? fetch(deleteApi, {
              method: "POST",
              body: fd,
          }).then(() => {
              wrap.innerHTML = "";
              getData();
          })
        : 0;
}


// // 分頁
// dataCopy = JSON.parse(localStorage.getItem("data"));
// console.log(dataCopy);
// //分頁按鈕生成
// function limits() {
//     countLim = Math.ceil(dataCopy.length / len); //總頁數
//     //餘數算一頁向上取整
    
//     inputs.innerHTML = "";
//     for (let i = 1; i <= countLim; i++) {
//         inputs.innerHTML += `<input type="button" value="${i}" onclick="limitinput(this)" >`; //每個頁面按鈕都繫結上一個點擊事件,this綁定點擊的元素
//     }
// }
// limits();



     
// function tablestr(num) {
//     //num是指當前哪個頁面
//     // console.log(num);
//     let num1 = (num - 1) * len; //確定迴圈開始的集合下標  1的時候=0 ,2的時候=3 ,8的時候=21

//     let num2 = num * len; //確定迴圈結束的結束下標  1的時候 = 3 ,2的時候=6 ,8的時候=24

//     wrap.innerHTML = ""; //清空一下

//     for (let i = num1; i < num2; i++) {
//         //遍歷陣列
//         if (i >= dataCopy.length) {
//             i = dataCopy.length;
//             return;
//         }
//          str = "";

//         str += `<td>${dataCopy[i].course_sid}</td>
//         <td scope="row" class="pic">
//        <img src="../../images/29/${dataCopy[i].course_img_s}" alt="" />
//    </td>
//    <td>${dataCopy[i].course_name}</td>
//    <td class="course_level">${dataCopy[i].course_level}</td>
//    <td>NT$${dataCopy[i].course_price}</td>
//    <td><a href="edit-data.html"><i class="fa-solid fa-pen-to-square" onclick="editDataA(${dataCopy[i].course_sid})"></i></a></td>
//    <td><a href=""><i class="fa-solid fa-trash-can" onclick="deleteData(${dataCopy[i].course_sid})"></i></a></td>`;

//         wrap.innerHTML += `<tr class="trs" data-index="${dataCopy[i].course_name}">  ${str}  </tr>`; //每迴圈一次新增一條資料
//     }
// }
// tablestr(1); // 初始第一頁





// function liminputcolor(choose) {
//     console.log(choose)
//     // 這裡childNodes把inputs子節點集合起來索引值0開始,所以-1
//     inputs.childNodes[choose - 1].style.backgroundColor = "red";
// }
// inputs.childNodes[0].style.backgroundColor = "red"; //第一個按鈕的背景顏色為紅色



// function levelfun() {
//     for (let i = 0; i < dataCopy.length; i++) {
        

//         if (i < len) {
//             courseLevel =
//                     document.querySelectorAll(".course_level");
//                 if (dataCopy[i].course_level === "1") {
//                     courseLevel[i].innerHTML = "入門";
//                 }
//                 if (dataCopy[i].course_level === "2") {
//                     courseLevel[i].innerHTML = "中級";
//                 }
//                 if (dataCopy[i].course_level === "3") {
//                     courseLevel[i].innerHTML = "高級";
//                 }
//         }
//     }
// }
// levelfun();



// function limitinput(i) {
//     console.log(i);
//     //監聽事件的this會把點擊當下的value帶進來,用來改變現在點擊的CSS,跟渲染當頁資料
//     choose = i.value;
//     tablestr(choose); //重新整理table資料
//     limits(); //重新整理頁面按鈕
//     // i.style.backgroundColor = "red"; //當前點選的頁面按鈕背景顏色改變為紅色,函式就有這個功能了所以先關掉
//     liminputcolor(choose); //頁面按鈕變色
//     levelfun()
// }










