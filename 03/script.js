let currentArray = [5, 2, 8, 1, 9];
let operationType = '';

// Display array on page load
window.addEventListener('DOMContentLoaded', function () {
    displayOriginal();
});

// Get array from input
function getArray() {
    const input = document.getElementById('arrayInput').value;
    return input.split(',').map(num => parseInt(num.trim())).filter(num => !isNaN(num));
}

// Display original array
function displayOriginal() {
    currentArray = getArray();
    document.getElementById('originalArray').textContent = '[ ' + currentArray.join(', ') + ' ]';
    clearResult();
}

// Display result
function displayResult(arr, msg = '') {
    document.getElementById('result').textContent = '[ ' + arr.join(', ') + ' ]';
    if (msg) {
        document.getElementById('message').textContent = msg;
        document.getElementById('message').classList.add('show');
    } else {
        document.getElementById('message').classList.remove('show');
    }
}

// Clear result
function clearResult() {
    document.getElementById('result').textContent = '[ ]';
    document.getElementById('message').classList.remove('show');
    document.getElementById('searchSection').style.display = 'none';
}

// 1. Reverse Array
function reverseArray() {
    displayOriginal();
    const arr = getArray();
    const reversed = arr.reverse();
    displayResult(reversed, '✓ Array reversed successfully!');
    operationType = '';
}

// 2. Sort Ascending
function sortAscending() {
    displayOriginal();
    const arr = getArray();
    const sorted = arr.sort((a, b) => a - b);
    displayResult(sorted, '✓ Array sorted in ascending order!');
    operationType = '';
}

// 3. Sort Descending
function sortDescending() {
    displayOriginal();
    const arr = getArray();
    const sorted = arr.sort((a, b) => b - a);
    displayResult(sorted, '✓ Array sorted in descending order!');
    operationType = '';
}

// 4. Linear Search
function linearSearch() {
    displayOriginal();
    document.getElementById('searchSection').style.display = 'flex';
    operationType = 'linear';
    document.getElementById('message').classList.remove('show');
}

// 5. Binary Search (requires sorted array)
function binarySearch() {
    displayOriginal();
    const arr = getArray();
    const sorted = arr.sort((a, b) => a - b);
    displayResult(sorted, 'ℹ Sorted for binary search. Enter value to search.');
    document.getElementById('searchSection').style.display = 'flex';
    operationType = 'binary';
}

// Perform Search
function performSearch() {
    const searchValue = parseInt(document.getElementById('searchValue').value);

    if (isNaN(searchValue)) {
        document.getElementById('message').textContent = '❌ Please enter a valid number!';
        document.getElementById('message').classList.add('show');
        return;
    }

    if (operationType === 'linear') {
        linearSearchOperation(searchValue);
    } else if (operationType === 'binary') {
        binarySearchOperation(searchValue);
    }

    document.getElementById('searchValue').value = '';
}

// Linear Search Implementation
function linearSearchOperation(target) {
    const arr = getArray();
    let index = -1;

    for (let i = 0; i < arr.length; i++) {
        if (arr[i] === target) {
            index = i;
            break;
        }
    }

    if (index !== -1) {
        displayResult(arr, `✓ Found! Value ${target} is at index ${index}`);
    } else {
        displayResult(arr, `❌ Not found! Value ${target} does not exist in array`);
    }
}

// Binary Search Implementation
function binarySearchOperation(target) {
    const arr = getArray().sort((a, b) => a - b);
    let left = 0;
    let right = arr.length - 1;
    let index = -1;

    while (left <= right) {
        const mid = Math.floor((left + right) / 2);
        if (arr[mid] === target) {
            index = mid;
            break;
        } else if (arr[mid] < target) {
            left = mid + 1;
        } else {
            right = mid - 1;
        }
    }

    if (index !== -1) {
        displayResult(arr, `✓ Found! Value ${target} is at index ${index}`);
    } else {
        displayResult(arr, `❌ Not found! Value ${target} does not exist in array`);
    }
}

// Reset
function reset() {
    document.getElementById('arrayInput').value = '5, 2, 8, 1, 9';
    displayOriginal();
    document.getElementById('searchSection').style.display = 'none';
    operationType = '';
}

// Allow Enter key for search
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('searchValue').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });

    document.getElementById('arrayInput').addEventListener('change', displayOriginal);
});
