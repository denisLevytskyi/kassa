const list_function = (name_index = '') => {
    const list = document.getElementById('listWrap' + name_index).children;
    const previous = document.getElementById('previous' + name_index);
    const next = document.getElementById('next' + name_index);
    const all = document.getElementById('all' + name_index);
    const step = 10;

    let index = step;

    const add_deactivate = () => {
        let list_item;
        for (list_item of list) {
            list_item.classList.add('deactivate');
        }
    }

    const remove_deactivate = (start, stop) => {
        while (start < stop) {
            list[start].classList.remove('deactivate');
            start++;
        }
    }

    if (list.length > step) {
        add_deactivate();
        remove_deactivate(0, step);
        next.classList.remove('deactivate');
        previous.classList.remove('deactivate');
        all.classList.remove('deactivate');
    }

    next.addEventListener('click', () => {
        if (index < list.length) {
            index += step;
            add_deactivate();
            remove_deactivate(index - step, index);
        }
    })

    previous.addEventListener('click', () => {
        if (index > step) {
            index -= step;
            add_deactivate();
            remove_deactivate(index - step, index);
        }
    })

    all.addEventListener('click', () => {
        let list_item;
        for (list_item of list) {
            list_item.classList.remove('deactivate');
        }
    })
}

list_function();