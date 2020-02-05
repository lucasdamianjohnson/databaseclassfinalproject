call create_exam("quiz77");
call create_question(1,"quiz77",3,"What is a delimiter?");
call create_question(2,"quiz77",4,"How do you drop a table?");
call create_question(3,"quiz77",3,"How do you update a table?");
call set_answer("quiz77",1,'C');
call set_answer("quiz77",2,'D');
call set_answer("quiz77",3,'C');
  call create_choice("quiz77",1,"A","a way to limit water flow");
  

  call create_choice("quiz77",1,"B","something to make something unlimited");
  

  call create_choice("quiz77",1,"C","the char(s) that define the end of a statment in MySQL");
  

  call create_choice("quiz77",2,"A","by throwing it out the window");
  

  call create_choice("quiz77",2,"B","by drop kicking it");
  

  call create_choice("quiz77",2,"C","by picking it up and droping it");
  

  call create_choice("quiz77",2,"D","by using the drop table function in MySQL");
    call create_choice("quiz77",3,"A","update table tablename");
 

  call create_choice("quiz77",3,"B","update table tablename where id = 'something'");
 

  call create_choice("quiz77",3,"C","update table tablename set id = 'something' where id = 'something'");
  call assign_exam("quiz77","alice");