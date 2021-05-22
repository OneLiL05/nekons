// import {alert} from "./components/alert.js";

const changeThemeBtn = document.querySelector('.change-theme'),
      commentBtn = document.getElementById('create-comment');

changeThemeBtn.addEventListener('click', function (){
    document.body.classList.toggle('light-theme');
    document.body.classList.toggle('dark-theme');
});

// commentBtn.addEventListener('click', function (){
//     comment.create();
//     comment.resetInput();
// });
