update user_types set user_types_name='Super' where id=1;
update user_types set user_types_name='Admin' where id=2;
update user_types set user_types_name='Staff' where id=3;
delete from  user_types where id > 3;
update users set full_name='Super',user_types_id=1 where id=1 ;
update users set full_name='Nagercoil',user_types_id=2 where id=15 ;
update users set full_name='Parvathipuram',user_types_id=2 where id=16 ;
update users set full_name='Nagercoil Staff',user_types_id=3 where id=17 ;
update users set full_name='Parvathipuram Staff',user_types_id=3 where id=18 ;
update users set first_name='',last_name='';  

--git remote add origin https://github.com/universekannan/shop.nalavariyam.org.git