import './bootstrap';

window.showUpdateMenu = function (state) {
    document.querySelectorAll('.information').forEach(element => {
        element.hidden = state;
    });

    document.querySelectorAll('.infocrud').forEach(element => {
        element.hidden = !state;
    });
}

window.showCreateMenu = function (state) {
    document.querySelectorAll('.createobj').forEach(element => {
        element.hidden = !state;
    });

    document.querySelectorAll('.information').forEach(element => {
        element.hidden = state;
    });

    document.querySelectorAll('.infocrud').forEach(element => {
        element.hidden = true;
    });
}

window.deleteProduct = function (id) {
    document.getElementById(`deleteForm${id}`).submit();
}
