// document.addEventListener('DOMContentLoaded', function () {
//     var inputNumber = document.getElementById('input-number');
//     var incrementButton = document.getElementById('increment');
//     var decrementButton = document.getElementById('decrement');

//     incrementButton.addEventListener('click', function () {
//         var currentValue = parseInt(inputNumber.value);
//         inputNumber.value = currentValue + 1;
//     });

//     decrementButton.addEventListener('click', function () {
//         var currentValue = parseInt(inputNumber.value);
//         if (currentValue > 1) {
//             inputNumber.value = currentValue - 1;
//         }
//     });
// });
document.getElementById('decrement').addEventListener('click', function (e) {
    e.preventDefault();
    var input = document.getElementById('input-number');
    var currentValue = parseInt(input.value);
    if (currentValue > 1) {
        input.value = currentValue - 1;
    }
});

document.getElementById('increment').addEventListener('click', function (e) {
    e.preventDefault();
    var input = document.getElementById('input-number');
    var currentValue = parseInt(input.value);
    input.value = currentValue + 1;
});