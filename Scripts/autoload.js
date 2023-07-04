const get_reload = () => {
    location.reload();
}

const reload_function =  (time = 2500) => {
    console.log(time/1000);
    setTimeout(() => {
        get_reload();
    }, time);
}

reload_function();