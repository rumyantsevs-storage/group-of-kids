<?php
    # Константы

    define("BOYSNUMBER", 5);
    define("GIRLSNUMBER", BOYSNUMBER);
    define("NONE", "Неизвестно");
    define("AGE_MIN", 7);
    define("AGE_MAX", 15);
    
    class Boy
    {
        public $age = NONE;
        public $hairColor = NONE;
        public $fname = NONE;
        public $lname = NONE;
        
        # Применение инкапсуляции. Свойство ниже не может быть использовано по
        # своему имени извне, но может быть изменено методом своего объекта.
        
        private $smokingAddictive = NONE;
        
        # Метод автозаполнения свойств объекта зарезервированными значениями
        
        public function autoSet()
        {
            $boyFnames = [ "Иван", "Петр", "Сергей", "Павел", "Михаил" ];
            $boyLnames = [ "Иванов", "Петров", "Сидоров", "Васечкин",
                "Давыдов" ];
            $hairColors = [ "Русый", "Рыжий", "Темный" ];
            
            $this->fname = $boyFnames[array_rand($boyFnames)];
            $this->lname = $boyLnames[array_rand($boyLnames)];
            $this->age = rand(AGE_MIN, AGE_MAX);
            $this->hairColor = $hairColors[array_rand($hairColors)];
            $this->smokingAddictive = intdiv(rand(1, 100), 35) ? "Нет" : "Да";
        }
        
        public function __toString()
        {
            return __CLASS__;
        }
    }
    
    // Применение наследования. Создается класс Girl, подобный Boy, включающий
    // в себя дополнительное свойство fingernailColored.
    
    class Girl extends Boy
    {
        public $fingernailColored = NONE;
        
        /*
         * Применение полиморфизма. Функция autoSet, предназначенная для
         * самостоятельного заполнения полей объекта вызавается также, как и в
         * объекте наследования, но отрабатывается несколько иначе.
         */
        
        public function autoSet()
        {
            $girlFnames = [ "Ольга", "Светлана", "Наталья", "Марина",
                "Юлия" ];
            $girlLnames = [ "Попова", "Смирнова", "Соколова", "Лебедева",
                "Волкова" ];
            $hairColors = [ "Русый", "Рыжий", "Темный" ];
            
            $this->fname = $girlFnames[array_rand($girlFnames)];
            $this->lname = $girlLnames[array_rand($girlLnames)];
            $this->age = rand(AGE_MIN, AGE_MAX);
            $this->hairColor = $hairColors[array_rand($hairColors)];
            $this->smokingAddictive = intdiv(rand(1, 100), 10) ? "Нет" : "Да";
            $this->fingernailColored = intdiv(rand(1, 100), 30) ? "Нет" : "Да";
        }
        
        public function __toString()
        {
            return __CLASS__;
        }
    }
    
    # Заполнение группы детей в виде массива объектов
    
    $kids = array();
    
    for ($i = 0; $i < BOYSNUMBER; ++$i) {
        $kids[] = new Boy();
        end($kids)->autoSet();
    }
    
    for ($i = 0; $i < GIRLSNUMBER; ++$i) {
        $kids[] = new Girl();
        end($kids)->autoSet();
    }
    
    # Вывод эелементов массива в таблицу HTML
    
    echo "<tr>";
    echo "<td><b>Имя</b></td>";
    echo "<td><b>Фамилия</b></td>";
    echo "<td><b>Возраст</b></td>";
    echo "<td><b>Цвет волос</b></td>";
    echo "<td><b>Накрашенность ногтей (у девочек)</b></td>";
    echo "</tr>";
    
    foreach ($kids as $kid) {
        echo "<tr>";
        echo "<td>$kid->fname</td>";
        echo "<td>$kid->lname</td>";
        echo "<td>$kid->age</td>";
        echo "<td>$kid->hairColor</td>";
        if ($kid->__toString() == "Girl") {
            echo "<td>$kid->fingernailColored</td>";
        }
        else {
            echo "<td>&mdash;</td>";
        }
        echo "</tr>";
    }
?>
