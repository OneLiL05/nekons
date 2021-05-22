class Comment {
    constructor() {

    }

    create(){
        const comments = document.getElementById('comments');
        const createComment = document.createElement('div');
        this.content = document.querySelector('.comment-input').value;
        createComment.className = 'comment-item';
        createComment.innerHTML = `
        <div class="item-img">
            <svg class="icon-sm" aria-hidden="true">
                <use xlink:href="../img/icons/profile-icon.svg#profile"></use>
            </svg>
        </div>
        <div class="item-text">
            <a href="../profile/profile.html" class="simple-text">pump_vasily</a>
            <p class="sub-text">${this.content}</p>
        </div>
        `;
        comments.prepend(createComment);
    }

    resetInput(){
        const commentInput = document.querySelector('.comment-input');
        commentInput.value = '';
    }
}

export const comment = new Comment();