// Задание 1
function pickPropArray(array, property) {
    let result = [];
    for (let i = 0; i < array.length; i++){
        if (array[i][property] !==  undefined)
            result.push(array[i][property]);
    }
    return result; 
}

// Задание 2
function createCounter(){
    let count = 0;
    return function () {
      count++;
      return count;
    }
}

// Задание 3
function spinWords(str){
    let array = str.split(" ");
    let result = [];
    for (let i = 0; i < array.length; i++){
        if (array[i].length >= 5) 
            result.push(array[i].split("").reverse().join(""));
        else 
            result.push(array[i]);
    }
    return result.join(" ");
}

// Задание 4
function getIndexes(nums, target) {
    for (let i = 0; i< nums.length; i++){
        for (let j = 0; j < nums.length; j++)
            if (nums[i] + nums[j] == target)
                return [i, j]
    }
    return [];
}

// Задание 5
function getLongString(arr) {
    if (arr.length === 0) return "";
    let result = "";

    function pairfinder(substring) {
        return arr.every(word => word.includes(substring));
    }

    const firstWord = arr[0];
    for (let i = 0; i < firstWord.length; i++) {
        for (let j = i + 1; j <= firstWord.length; j++) {
            const substring = firstWord.slice(i, j);
            if (pairfinder(substring) && substring.length > result.length) {
                result = substring;
            }
        }
    }
    if (result.length >= 2){ 
        return result; 
    } else { 
        return ""; 
    }
}

// Тесты
console.log(getLongString(["цветок", "поток", "хлопок"])); // Ожидается "ок"
console.log(getLongString(["собака", "гоночная машина", "машина"])); // Ожидается ""
console.log(getLongString(["столовая", "столб", "столешница"])); // Ожидается "стол"
console.log(getLongString(["мусор", "сорняк"])); // Ожидается "сор"
