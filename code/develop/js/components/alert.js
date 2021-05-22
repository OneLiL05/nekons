class Alert {
    constructor() {
        this.create = document.createElement('span');
        this.place = document.querySelector('main');
        this.clicked = false;
    }

    successAlert(content, btnContent){
        this.title = content;
        this.btnContent = btnContent;
        this.create.className = 'alert';
        this.create.innerHTML =
            `<span class="g1">
               <svg class="icon-sm left-space-sm">
                   <use xlink:href="../img/icons/delete-icon.svg#delete"></use>
               </svg> 
               <p class="sub-text">${this.title}</p>
            </span>
                <button class="tertiary-btn-sm return-item">${this.btnContent}</button>
            `;

        this.place.append(this.create);
        this.close();
        this.destroyHandly();
        setTimeout(this.destroy, 3000)
    };

    destroy(){
        const alertItem = document.querySelector('.alert'),
              item = document.querySelector('.item');

        alertItem.remove();
        item.remove()
    };

    destroyHandly(){
        const alertItem = document.querySelector('.alert');
        const returnItem = document.querySelector('.return-item');
        returnItem.addEventListener('click', function (){
            alertItem.remove();
        });
    };

    close(){
        const returnItem = document.querySelector('.return-item');
        returnItem.addEventListener('click', function (){
            const item = document.querySelector('.item'),
                  checkedItem = document.querySelector('.checked-item');
            item.style.display = 'flex';
            checkedItem.style.display = 'flex';
        });
    };

    closeMultiply() {
        const returnItem = document.querySelector('.return-item');
        returnItem.addEventListener('click', function (){
            const items = document.querySelectorAll('.item'),
                  checkedItems = document.querySelectorAll('.checked-item');

            items.forEach(item => {
               item.style.display = 'flex'
            });

            checkedItems.forEach(checkedItem => {
                checkedItem.style.display = 'none';
            });
        });
    }
}

export const alert = new Alert();
