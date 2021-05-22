import {deleteCheckedItem} from "../modules/functions.js";
import {alert} from "./alert.js";

class Notification {

    simpleNotification(){
        this.href = '../img/icons/check-icon.svg#check';
        const createNotification = document.createElement('a');
        createNotification.className = 'item';
        createNotification.innerHTML = `
        <div class="item-block">
            <div role="img">
                <img class="item-img" src="../img/musubaru-yakeato-cover.jpg" alt="Обложка манги">
            </div>
            <div class="item-text" role="contentinfo">
                <p class="simple-text">manga</p>
                <p class="sub-text">manga</p>
            </div>
        </div>
        <div class="date" role="contentinfo">
        <p class="sub-text">21:49</p>
        <p class="sub-text">08.02.2021</p>
        </div>
        <button type="button" class="icon-btn right-space-md check-notification" aria-label="">
            <svg class="icon-sm" aria-hidden="true">
                <use class="icon-href" xlink:href="../img/icons/check-icon.svg#check"></use>
            </svg>
        </button>
        `;
    };

    checkedNotification(){
        const notificationItem = document.querySelector('.item'),
              items = document.querySelector('.items'),
              notificationIcon = document.querySelector('.notification-icon'),
              checkNotificationBtn = document.querySelector('.check-notification');

        notificationItem.className = 'checked-item';
        notificationIcon.innerHTML = `
            <use xlink:href="../img/icons/delete-icon.svg#delete"></use>
        `;
        checkNotificationBtn.className = 'delete-item icon-btn';
        items.append(notificationItem);

        deleteCheckedItem();
    };
}

const notification = new Notification(),
      checkNotificationBtn = document.querySelector('.check-notification'),
      checkAllNotificationsBtn = document.getElementById('check-notifications'),
      deleteAllNotificationsBtn = document.getElementById('delete-notifications'),
      showReadNotificationsBtn = document.querySelector('.read'),
      showNonReadNotificationsBtn = document.querySelector('.non-read');

checkNotificationBtn.addEventListener('click', function (){
    notification.checkedNotification();
});

checkAllNotificationsBtn.addEventListener('click', function (){
    const checkAllNotifications = document.querySelectorAll('.item');
    checkAllNotifications.forEach(checkNotification => {
       checkNotification.className = 'checked-item notification'
    });
});

deleteAllNotificationsBtn.addEventListener('click', function (){
   const notifications = document.querySelectorAll('.notification');
   notifications.forEach(notification => {
       notification.style.display = 'none';
       alert.successAlert('Уведомление удаленно', 'Отмена');
       alert.closeMultiply();
   });
});

showReadNotificationsBtn.addEventListener('click', function (){
    const items = document.querySelectorAll('.item'),
          checkedItems = document.querySelectorAll('.checked-item');
    items.forEach(item => {
        item.style.display = 'none';
    });

    checkedItems.forEach(checkedItem => {
        checkedItem.style.display = 'flex';
    });
});

showNonReadNotificationsBtn.addEventListener('click', function (){
    const checkedItems = document.querySelectorAll('.checked-item');
    const items = document.querySelectorAll('.item');
    items.forEach(item => {
        item.style.display = 'flex';
    });

    checkedItems.forEach(checkedItem => {
        checkedItem.style.display = 'none';
    });
});

