const list = document.getElementById('listWrap').children;
const previous = document.getElementById('previous');
const next = document.getElementById('next');
const all = document.getElementById('all');
const step = 10;

let index = step;

const add_display_none = () => {
    let list_item;
    for (list_item of list) {
        list_item.classList.add('deactivate');
    }
}

const add_display = (start, stop) => {
    while (start < stop) {
        list[start].classList.add('active');
        list[start].classList.remove('deactivate');
        start++;
    }
}

if (list.length > step) {
    add_display_none();
    add_display(0, step);
    next.classList.remove('deactivate');
    previous.classList.remove('deactivate');
    all.classList.remove('deactivate');
}

next.addEventListener('click', () => {
    if (index < list.length) {
        index += step;
        add_display_none();
        add_display(index - step, index);
    }
})

previous.addEventListener('click', () => {
    if (index > step) {
        index -= step;
        add_display_none();
        add_display(index - step, index);
    }
})

all.addEventListener('click', () => {
    let list_item;
    for (list_item of list) {
        list_item.classList.remove('deactivate');
    }
})