import {alert} from "../components/alert.js";

export function deleteItem() {
    const deleteItemBtn = document.querySelector('.delete-item');
    deleteItemBtn.addEventListener('click', function (){
        const item = document.querySelector('.item');
        item.style.display = 'none';
        alert.successAlert('Тайтл удалён из закладок', 'Отмена');
    });
}

export function deleteCheckedItem() {
    const deleteItemBtn = document.querySelector('.delete-item');
    deleteItemBtn.addEventListener('click', function (){
        const checkedItem = document.querySelector('.checked-item');
        checkedItem.style.display = 'none';
        alert.successAlert('Тайтл удалён из закладок', 'Отмена');
    });
}