const list2 = document.getElementById('listWrap2').children;
const previous2 = document.getElementById('previous2');
const next2 = document.getElementById('next2');
const all2 = document.getElementById('all2');
const step2 = 15;

let index2 = step2;

const add_display_none2 = () => {
    let list_item;
    for (list_item of list2) {
        list_item.classList.add('deactivate');
    }
}

const add_display2 = (start, stop) => {
    while (start < stop) {
        list2[start].classList.add('active');
        list2[start].classList.remove('deactivate');
        start++;
    }
}

if (list2.length > step2) {
    add_display_none2();
    add_display2(0, step2);
    next2.classList.remove('deactivate');
    previous2.classList.remove('deactivate');
    all2.classList.remove('deactivate');
}

next2.addEventListener('click', () => {
    if (index2 < list2.length) {
        index2 += step2;
        add_display_none2();
        add_display2(index2 - step2, index2);
    }
})

previous2.addEventListener('click', () => {
    if (index2 > step2) {
        index2 -= step2;
        add_display_none2();
        add_display2(index2 - step2, index2);
    }
})

all2.addEventListener('click', () => {
    let list_item;
    for (list_item of list2) {
        list_item.classList.remove('deactivate');
    }
})