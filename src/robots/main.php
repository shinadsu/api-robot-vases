<?php 
// Инициализация переменных
$pos1 = 0; // позиция первого робота
$pos2 = 0; // позиция второго робота
$flag = false; // флаг, определяющий, находятся ли роботы на черной клетке

// Цикл программы
while (true) {
    // Проверка флага
    if ($flag) {
        // Если роботы находятся на черной клетке, они встречаются
        echo "Robots meet on black cell at position $pos1 and $pos2\n";
        break; // Выход из цикла
    }

    // Проверка позиции
    if ($pos1 == $pos2) {
        // Если позиции роботов совпадают, они встречаются
        echo "Robots meet at position $pos1\n";
        break; // Выход из цикла
    }

    // Шаг первого робота
    if ($pos1 < $pos2) {
        $pos1++; // Сдвигаем первого робота на одну клетку вправо
        echo "Robot 1 moves right to position $pos1\n";
    } else {
        $pos1--; // Сдвигаем первого робота на одну клетку влево
        echo "Robot 1 moves left to position $pos1\n";
    }

    // Шаг второго робота
    if ($pos2 < $pos1) {
        $pos2++; // Сдвигаем второго робота на одну клетку вправо
        echo "Robot 2 moves right to position $pos2\n";
    } else {
        $pos2--; // Сдвигаем второго робота на одну клетку влево
        echo "Robot 2 moves left to position $pos2\n";
    }

    // Задержка на выполнение команды
    sleep(1);

    // Проверка цвета клетки
    if ($pos1 == $pos2) {
        $flag = true; // Роботы находятся на черной клетке
    } else {
        $flag = false; // Роботы не находятся на черной клетке
    }
}