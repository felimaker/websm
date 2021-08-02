var FiltersEnabled = 0; // if your not going to use transitions or filters in any of the tips set this to 0
var spacer="&nbsp; &nbsp; &nbsp; ";

// email notifications to admin
notifyAdminNewMembers0Tip=["", spacer+"No email notifications to admin."];
notifyAdminNewMembers1Tip=["", spacer+"Notify admin only when a new member is waiting for approval."];
notifyAdminNewMembers2Tip=["", spacer+"Notify admin for all new sign-ups."];

// visitorSignup
visitorSignup0Tip=["", spacer+"If this option is selected, visitors will not be able to join this group unless the admin manually moves them to this group from the admin area."];
visitorSignup1Tip=["", spacer+"If this option is selected, visitors can join this group but will not be able to sign in unless the admin approves them from the admin area."];
visitorSignup2Tip=["", spacer+"If this option is selected, visitors can join this group and will be able to sign in instantly with no need for admin approval."];

// dispositivos table
dispositivos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Dispositivos Biomedicos' table. A member who adds a record to the table becomes the 'owner' of that record."];

dispositivos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Dispositivos Biomedicos' table."];
dispositivos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Dispositivos Biomedicos' table."];
dispositivos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Dispositivos Biomedicos' table."];
dispositivos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Dispositivos Biomedicos' table."];

dispositivos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Dispositivos Biomedicos' table."];
dispositivos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Dispositivos Biomedicos' table."];
dispositivos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Dispositivos Biomedicos' table."];
dispositivos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Dispositivos Biomedicos' table, regardless of their owner."];

dispositivos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Dispositivos Biomedicos' table."];
dispositivos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Dispositivos Biomedicos' table."];
dispositivos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Dispositivos Biomedicos' table."];
dispositivos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Dispositivos Biomedicos' table."];

// mobiliario table
mobiliario_addTip=["",spacer+"This option allows all members of the group to add records to the 'Mobiliario' table. A member who adds a record to the table becomes the 'owner' of that record."];

mobiliario_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Mobiliario' table."];
mobiliario_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Mobiliario' table."];
mobiliario_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Mobiliario' table."];
mobiliario_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Mobiliario' table."];

mobiliario_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Mobiliario' table."];
mobiliario_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Mobiliario' table."];
mobiliario_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Mobiliario' table."];
mobiliario_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Mobiliario' table, regardless of their owner."];

mobiliario_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Mobiliario' table."];
mobiliario_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Mobiliario' table."];
mobiliario_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Mobiliario' table."];
mobiliario_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Mobiliario' table."];

// contactos table
contactos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Contactos' table. A member who adds a record to the table becomes the 'owner' of that record."];

contactos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Contactos' table."];
contactos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Contactos' table."];
contactos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Contactos' table."];
contactos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Contactos' table."];

contactos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Contactos' table."];
contactos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Contactos' table."];
contactos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Contactos' table."];
contactos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Contactos' table, regardless of their owner."];

contactos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Contactos' table."];
contactos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Contactos' table."];
contactos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Contactos' table."];
contactos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Contactos' table."];

// contactos_tipo_contacto table
contactos_tipo_contacto_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo de contacto' table. A member who adds a record to the table becomes the 'owner' of that record."];

contactos_tipo_contacto_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo de contacto' table."];
contactos_tipo_contacto_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo de contacto' table."];
contactos_tipo_contacto_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo de contacto' table."];
contactos_tipo_contacto_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo de contacto' table."];

contactos_tipo_contacto_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo de contacto' table."];
contactos_tipo_contacto_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo de contacto' table."];
contactos_tipo_contacto_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo de contacto' table."];
contactos_tipo_contacto_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo de contacto' table, regardless of their owner."];

contactos_tipo_contacto_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo de contacto' table."];
contactos_tipo_contacto_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo de contacto' table."];
contactos_tipo_contacto_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo de contacto' table."];
contactos_tipo_contacto_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo de contacto' table."];

// movimientos table
movimientos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Movimientos' table. A member who adds a record to the table becomes the 'owner' of that record."];

movimientos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Movimientos' table."];
movimientos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Movimientos' table."];
movimientos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Movimientos' table."];
movimientos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Movimientos' table."];

movimientos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Movimientos' table."];
movimientos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Movimientos' table."];
movimientos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Movimientos' table."];
movimientos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Movimientos' table, regardless of their owner."];

movimientos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Movimientos' table."];
movimientos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Movimientos' table."];
movimientos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Movimientos' table."];
movimientos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Movimientos' table."];

// documentos table
documentos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Documentos del dispositivo' table. A member who adds a record to the table becomes the 'owner' of that record."];

documentos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Documentos del dispositivo' table."];
documentos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Documentos del dispositivo' table."];
documentos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Documentos del dispositivo' table."];
documentos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Documentos del dispositivo' table."];

documentos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Documentos del dispositivo' table."];
documentos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Documentos del dispositivo' table."];
documentos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Documentos del dispositivo' table."];
documentos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Documentos del dispositivo' table, regardless of their owner."];

documentos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Documentos del dispositivo' table."];
documentos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Documentos del dispositivo' table."];
documentos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Documentos del dispositivo' table."];
documentos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Documentos del dispositivo' table."];

// mantenimientos table
mantenimientos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Mantenimientos' table. A member who adds a record to the table becomes the 'owner' of that record."];

mantenimientos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Mantenimientos' table."];
mantenimientos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Mantenimientos' table."];
mantenimientos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Mantenimientos' table."];
mantenimientos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Mantenimientos' table."];

mantenimientos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Mantenimientos' table."];
mantenimientos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Mantenimientos' table."];
mantenimientos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Mantenimientos' table."];
mantenimientos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Mantenimientos' table, regardless of their owner."];

mantenimientos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Mantenimientos' table."];
mantenimientos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Mantenimientos' table."];
mantenimientos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Mantenimientos' table."];
mantenimientos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Mantenimientos' table."];

// calibraciones table
calibraciones_addTip=["",spacer+"This option allows all members of the group to add records to the 'Calibraciones' table. A member who adds a record to the table becomes the 'owner' of that record."];

calibraciones_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Calibraciones' table."];
calibraciones_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Calibraciones' table."];
calibraciones_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Calibraciones' table."];
calibraciones_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Calibraciones' table."];

calibraciones_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Calibraciones' table."];
calibraciones_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Calibraciones' table."];
calibraciones_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Calibraciones' table."];
calibraciones_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Calibraciones' table, regardless of their owner."];

calibraciones_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Calibraciones' table."];
calibraciones_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Calibraciones' table."];
calibraciones_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Calibraciones' table."];
calibraciones_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Calibraciones' table."];

// unidades table
unidades_addTip=["",spacer+"This option allows all members of the group to add records to the 'Unidades Medicas' table. A member who adds a record to the table becomes the 'owner' of that record."];

unidades_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Unidades Medicas' table."];
unidades_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Unidades Medicas' table."];
unidades_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Unidades Medicas' table."];
unidades_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Unidades Medicas' table."];

unidades_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Unidades Medicas' table."];
unidades_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Unidades Medicas' table."];
unidades_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Unidades Medicas' table."];
unidades_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Unidades Medicas' table, regardless of their owner."];

unidades_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Unidades Medicas' table."];
unidades_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Unidades Medicas' table."];
unidades_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Unidades Medicas' table."];
unidades_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Unidades Medicas' table."];

// marcas table
marcas_addTip=["",spacer+"This option allows all members of the group to add records to the 'Marcas' table. A member who adds a record to the table becomes the 'owner' of that record."];

marcas_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Marcas' table."];
marcas_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Marcas' table."];
marcas_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Marcas' table."];
marcas_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Marcas' table."];

marcas_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Marcas' table."];
marcas_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Marcas' table."];
marcas_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Marcas' table."];
marcas_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Marcas' table, regardless of their owner."];

marcas_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Marcas' table."];
marcas_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Marcas' table."];
marcas_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Marcas' table."];
marcas_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Marcas' table."];

// marca_modelo table
marca_modelo_addTip=["",spacer+"This option allows all members of the group to add records to the 'Marca y Modelo' table. A member who adds a record to the table becomes the 'owner' of that record."];

marca_modelo_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Marca y Modelo' table."];
marca_modelo_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Marca y Modelo' table."];
marca_modelo_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Marca y Modelo' table."];
marca_modelo_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Marca y Modelo' table."];

marca_modelo_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Marca y Modelo' table."];
marca_modelo_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Marca y Modelo' table."];
marca_modelo_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Marca y Modelo' table."];
marca_modelo_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Marca y Modelo' table, regardless of their owner."];

marca_modelo_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Marca y Modelo' table."];
marca_modelo_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Marca y Modelo' table."];
marca_modelo_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Marca y Modelo' table."];
marca_modelo_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Marca y Modelo' table."];

// accesorios table
accesorios_addTip=["",spacer+"This option allows all members of the group to add records to the 'Accesorios' table. A member who adds a record to the table becomes the 'owner' of that record."];

accesorios_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Accesorios' table."];
accesorios_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Accesorios' table."];
accesorios_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Accesorios' table."];
accesorios_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Accesorios' table."];

accesorios_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Accesorios' table."];
accesorios_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Accesorios' table."];
accesorios_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Accesorios' table."];
accesorios_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Accesorios' table, regardless of their owner."];

accesorios_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Accesorios' table."];
accesorios_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Accesorios' table."];
accesorios_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Accesorios' table."];
accesorios_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Accesorios' table."];

// ciudades table
ciudades_addTip=["",spacer+"This option allows all members of the group to add records to the 'Ciudades' table. A member who adds a record to the table becomes the 'owner' of that record."];

ciudades_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Ciudades' table."];
ciudades_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Ciudades' table."];
ciudades_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Ciudades' table."];
ciudades_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Ciudades' table."];

ciudades_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Ciudades' table."];
ciudades_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Ciudades' table."];
ciudades_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Ciudades' table."];
ciudades_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Ciudades' table, regardless of their owner."];

ciudades_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Ciudades' table."];
ciudades_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Ciudades' table."];
ciudades_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Ciudades' table."];
ciudades_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Ciudades' table."];

// verificacion table
verificacion_addTip=["",spacer+"This option allows all members of the group to add records to the 'Verificacion' table. A member who adds a record to the table becomes the 'owner' of that record."];

verificacion_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Verificacion' table."];
verificacion_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Verificacion' table."];
verificacion_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Verificacion' table."];
verificacion_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Verificacion' table."];

verificacion_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Verificacion' table."];
verificacion_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Verificacion' table."];
verificacion_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Verificacion' table."];
verificacion_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Verificacion' table, regardless of their owner."];

verificacion_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Verificacion' table."];
verificacion_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Verificacion' table."];
verificacion_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Verificacion' table."];
verificacion_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Verificacion' table."];

// hojadevida table
hojadevida_addTip=["",spacer+"This option allows all members of the group to add records to the 'Hoja de vida' table. A member who adds a record to the table becomes the 'owner' of that record."];

hojadevida_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Hoja de vida' table."];
hojadevida_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Hoja de vida' table."];
hojadevida_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Hoja de vida' table."];
hojadevida_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Hoja de vida' table."];

hojadevida_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Hoja de vida' table."];
hojadevida_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Hoja de vida' table."];
hojadevida_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Hoja de vida' table."];
hojadevida_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Hoja de vida' table, regardless of their owner."];

hojadevida_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Hoja de vida' table."];
hojadevida_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Hoja de vida' table."];
hojadevida_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Hoja de vida' table."];
hojadevida_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Hoja de vida' table."];

// financiero table
financiero_addTip=["",spacer+"This option allows all members of the group to add records to the 'Financiero D' table. A member who adds a record to the table becomes the 'owner' of that record."];

financiero_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Financiero D' table."];
financiero_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Financiero D' table."];
financiero_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Financiero D' table."];
financiero_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Financiero D' table."];

financiero_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Financiero D' table."];
financiero_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Financiero D' table."];
financiero_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Financiero D' table."];
financiero_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Financiero D' table, regardless of their owner."];

financiero_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Financiero D' table."];
financiero_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Financiero D' table."];
financiero_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Financiero D' table."];
financiero_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Financiero D' table."];

// financiero_mobiliario table
financiero_mobiliario_addTip=["",spacer+"This option allows all members of the group to add records to the 'Financiero M' table. A member who adds a record to the table becomes the 'owner' of that record."];

financiero_mobiliario_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Financiero M' table."];
financiero_mobiliario_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Financiero M' table."];
financiero_mobiliario_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Financiero M' table."];
financiero_mobiliario_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Financiero M' table."];

financiero_mobiliario_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Financiero M' table."];
financiero_mobiliario_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Financiero M' table."];
financiero_mobiliario_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Financiero M' table."];
financiero_mobiliario_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Financiero M' table, regardless of their owner."];

financiero_mobiliario_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Financiero M' table."];
financiero_mobiliario_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Financiero M' table."];
financiero_mobiliario_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Financiero M' table."];
financiero_mobiliario_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Financiero M' table."];

// prestador table
prestador_addTip=["",spacer+"This option allows all members of the group to add records to the 'Prestador' table. A member who adds a record to the table becomes the 'owner' of that record."];

prestador_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Prestador' table."];
prestador_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Prestador' table."];
prestador_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Prestador' table."];
prestador_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Prestador' table."];

prestador_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Prestador' table."];
prestador_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Prestador' table."];
prestador_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Prestador' table."];
prestador_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Prestador' table, regardless of their owner."];

prestador_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Prestador' table."];
prestador_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Prestador' table."];
prestador_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Prestador' table."];
prestador_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Prestador' table."];

// docu_modelo table
docu_modelo_addTip=["",spacer+"This option allows all members of the group to add records to the 'Documentos del modelo' table. A member who adds a record to the table becomes the 'owner' of that record."];

docu_modelo_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Documentos del modelo' table."];
docu_modelo_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Documentos del modelo' table."];
docu_modelo_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Documentos del modelo' table."];
docu_modelo_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Documentos del modelo' table."];

docu_modelo_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Documentos del modelo' table."];
docu_modelo_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Documentos del modelo' table."];
docu_modelo_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Documentos del modelo' table."];
docu_modelo_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Documentos del modelo' table, regardless of their owner."];

docu_modelo_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Documentos del modelo' table."];
docu_modelo_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Documentos del modelo' table."];
docu_modelo_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Documentos del modelo' table."];
docu_modelo_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Documentos del modelo' table."];

// facturas table
facturas_addTip=["",spacer+"This option allows all members of the group to add records to the 'Facturas' table. A member who adds a record to the table becomes the 'owner' of that record."];

facturas_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Facturas' table."];
facturas_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Facturas' table."];
facturas_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Facturas' table."];
facturas_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Facturas' table."];

facturas_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Facturas' table."];
facturas_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Facturas' table."];
facturas_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Facturas' table."];
facturas_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Facturas' table, regardless of their owner."];

facturas_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Facturas' table."];
facturas_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Facturas' table."];
facturas_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Facturas' table."];
facturas_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Facturas' table."];

// formatos table
formatos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Formatos' table. A member who adds a record to the table becomes the 'owner' of that record."];

formatos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Formatos' table."];
formatos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Formatos' table."];
formatos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Formatos' table."];
formatos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Formatos' table."];

formatos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Formatos' table."];
formatos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Formatos' table."];
formatos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Formatos' table."];
formatos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Formatos' table, regardless of their owner."];

formatos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Formatos' table."];
formatos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Formatos' table."];
formatos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Formatos' table."];
formatos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Formatos' table."];

// dispo_fuera table
dispo_fuera_addTip=["",spacer+"This option allows all members of the group to add records to the 'Dispositivos da Baja' table. A member who adds a record to the table becomes the 'owner' of that record."];

dispo_fuera_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Dispositivos da Baja' table."];
dispo_fuera_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Dispositivos da Baja' table."];
dispo_fuera_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Dispositivos da Baja' table."];
dispo_fuera_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Dispositivos da Baja' table."];

dispo_fuera_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Dispositivos da Baja' table."];
dispo_fuera_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Dispositivos da Baja' table."];
dispo_fuera_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Dispositivos da Baja' table."];
dispo_fuera_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Dispositivos da Baja' table, regardless of their owner."];

dispo_fuera_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Dispositivos da Baja' table."];
dispo_fuera_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Dispositivos da Baja' table."];
dispo_fuera_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Dispositivos da Baja' table."];
dispo_fuera_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Dispositivos da Baja' table."];

// dispositivo_tipo_grupo table
dispositivo_tipo_grupo_addTip=["",spacer+"This option allows all members of the group to add records to the 'Grupo del dispositivo' table. A member who adds a record to the table becomes the 'owner' of that record."];

dispositivo_tipo_grupo_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Grupo del dispositivo' table."];
dispositivo_tipo_grupo_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Grupo del dispositivo' table."];
dispositivo_tipo_grupo_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Grupo del dispositivo' table."];
dispositivo_tipo_grupo_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Grupo del dispositivo' table."];

dispositivo_tipo_grupo_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Grupo del dispositivo' table."];
dispositivo_tipo_grupo_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Grupo del dispositivo' table."];
dispositivo_tipo_grupo_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Grupo del dispositivo' table."];
dispositivo_tipo_grupo_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Grupo del dispositivo' table, regardless of their owner."];

dispositivo_tipo_grupo_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Grupo del dispositivo' table."];
dispositivo_tipo_grupo_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Grupo del dispositivo' table."];
dispositivo_tipo_grupo_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Grupo del dispositivo' table."];
dispositivo_tipo_grupo_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Grupo del dispositivo' table."];

// tipo_relacion table
tipo_relacion_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo de relacion' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_relacion_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo de relacion' table."];
tipo_relacion_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo de relacion' table."];
tipo_relacion_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo de relacion' table."];
tipo_relacion_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo de relacion' table."];

tipo_relacion_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo de relacion' table."];
tipo_relacion_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo de relacion' table."];
tipo_relacion_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo de relacion' table."];
tipo_relacion_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo de relacion' table, regardless of their owner."];

tipo_relacion_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo de relacion' table."];
tipo_relacion_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo de relacion' table."];
tipo_relacion_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo de relacion' table."];
tipo_relacion_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo de relacion' table."];

// tipo_dispositivo table
tipo_dispositivo_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo de dispositivo' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_dispositivo_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo de dispositivo' table."];
tipo_dispositivo_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo de dispositivo' table."];
tipo_dispositivo_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo de dispositivo' table."];
tipo_dispositivo_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo de dispositivo' table."];

tipo_dispositivo_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo de dispositivo' table."];
tipo_dispositivo_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo de dispositivo' table."];
tipo_dispositivo_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo de dispositivo' table."];
tipo_dispositivo_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo de dispositivo' table, regardless of their owner."];

tipo_dispositivo_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo de dispositivo' table."];
tipo_dispositivo_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo de dispositivo' table."];
tipo_dispositivo_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo de dispositivo' table."];
tipo_dispositivo_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo de dispositivo' table."];

// tipo_documento table
tipo_documento_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo de documento' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_documento_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo de documento' table."];
tipo_documento_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo de documento' table."];
tipo_documento_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo de documento' table."];
tipo_documento_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo de documento' table."];

tipo_documento_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo de documento' table."];
tipo_documento_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo de documento' table."];
tipo_documento_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo de documento' table."];
tipo_documento_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo de documento' table, regardless of their owner."];

tipo_documento_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo de documento' table."];
tipo_documento_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo de documento' table."];
tipo_documento_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo de documento' table."];
tipo_documento_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo de documento' table."];

// tipo_iden table
tipo_iden_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo de identificacion' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_iden_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo de identificacion' table."];
tipo_iden_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo de identificacion' table."];
tipo_iden_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo de identificacion' table."];
tipo_iden_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo de identificacion' table."];

tipo_iden_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo de identificacion' table."];
tipo_iden_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo de identificacion' table."];
tipo_iden_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo de identificacion' table."];
tipo_iden_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo de identificacion' table, regardless of their owner."];

tipo_iden_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo de identificacion' table."];
tipo_iden_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo de identificacion' table."];
tipo_iden_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo de identificacion' table."];
tipo_iden_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo de identificacion' table."];

// tipo_razon_social table
tipo_razon_social_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo de razon social' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_razon_social_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo de razon social' table."];
tipo_razon_social_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo de razon social' table."];
tipo_razon_social_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo de razon social' table."];
tipo_razon_social_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo de razon social' table."];

tipo_razon_social_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo de razon social' table."];
tipo_razon_social_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo de razon social' table."];
tipo_razon_social_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo de razon social' table."];
tipo_razon_social_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo de razon social' table, regardless of their owner."];

tipo_razon_social_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo de razon social' table."];
tipo_razon_social_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo de razon social' table."];
tipo_razon_social_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo de razon social' table."];
tipo_razon_social_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo de razon social' table."];

// tipo_mobiliario table
tipo_mobiliario_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo de Mobiliario' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_mobiliario_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo de Mobiliario' table."];
tipo_mobiliario_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo de Mobiliario' table."];
tipo_mobiliario_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo de Mobiliario' table."];
tipo_mobiliario_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo de Mobiliario' table."];

tipo_mobiliario_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo de Mobiliario' table."];
tipo_mobiliario_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo de Mobiliario' table."];
tipo_mobiliario_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo de Mobiliario' table."];
tipo_mobiliario_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo de Mobiliario' table, regardless of their owner."];

tipo_mobiliario_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo de Mobiliario' table."];
tipo_mobiliario_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo de Mobiliario' table."];
tipo_mobiliario_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo de Mobiliario' table."];
tipo_mobiliario_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo de Mobiliario' table."];

// tipo_grupo_mobilia table
tipo_grupo_mobilia_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo grupo mobiliario' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_grupo_mobilia_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo grupo mobiliario' table."];
tipo_grupo_mobilia_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo grupo mobiliario' table."];
tipo_grupo_mobilia_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo grupo mobiliario' table."];
tipo_grupo_mobilia_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo grupo mobiliario' table."];

tipo_grupo_mobilia_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo grupo mobiliario' table."];
tipo_grupo_mobilia_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo grupo mobiliario' table."];
tipo_grupo_mobilia_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo grupo mobiliario' table."];
tipo_grupo_mobilia_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo grupo mobiliario' table, regardless of their owner."];

tipo_grupo_mobilia_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo grupo mobiliario' table."];
tipo_grupo_mobilia_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo grupo mobiliario' table."];
tipo_grupo_mobilia_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo grupo mobiliario' table."];
tipo_grupo_mobilia_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo grupo mobiliario' table."];

// tipo_estado_dispo table
tipo_estado_dispo_addTip=["",spacer+"This option allows all members of the group to add records to the 'Estado del dispositivo' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_estado_dispo_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Estado del dispositivo' table."];
tipo_estado_dispo_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Estado del dispositivo' table."];
tipo_estado_dispo_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Estado del dispositivo' table."];
tipo_estado_dispo_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Estado del dispositivo' table."];

tipo_estado_dispo_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Estado del dispositivo' table."];
tipo_estado_dispo_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Estado del dispositivo' table."];
tipo_estado_dispo_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Estado del dispositivo' table."];
tipo_estado_dispo_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Estado del dispositivo' table, regardless of their owner."];

tipo_estado_dispo_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Estado del dispositivo' table."];
tipo_estado_dispo_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Estado del dispositivo' table."];
tipo_estado_dispo_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Estado del dispositivo' table."];
tipo_estado_dispo_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Estado del dispositivo' table."];

// tipo_movimiento table
tipo_movimiento_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo de movimiento' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_movimiento_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo de movimiento' table."];
tipo_movimiento_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo de movimiento' table."];
tipo_movimiento_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo de movimiento' table."];
tipo_movimiento_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo de movimiento' table."];

tipo_movimiento_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo de movimiento' table."];
tipo_movimiento_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo de movimiento' table."];
tipo_movimiento_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo de movimiento' table."];
tipo_movimiento_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo de movimiento' table, regardless of their owner."];

tipo_movimiento_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo de movimiento' table."];
tipo_movimiento_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo de movimiento' table."];
tipo_movimiento_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo de movimiento' table."];
tipo_movimiento_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo de movimiento' table."];

// tipo_estado_movi table
tipo_estado_movi_addTip=["",spacer+"This option allows all members of the group to add records to the 'Estado del movimiento' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_estado_movi_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Estado del movimiento' table."];
tipo_estado_movi_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Estado del movimiento' table."];
tipo_estado_movi_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Estado del movimiento' table."];
tipo_estado_movi_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Estado del movimiento' table."];

tipo_estado_movi_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Estado del movimiento' table."];
tipo_estado_movi_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Estado del movimiento' table."];
tipo_estado_movi_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Estado del movimiento' table."];
tipo_estado_movi_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Estado del movimiento' table, regardless of their owner."];

tipo_estado_movi_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Estado del movimiento' table."];
tipo_estado_movi_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Estado del movimiento' table."];
tipo_estado_movi_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Estado del movimiento' table."];
tipo_estado_movi_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Estado del movimiento' table."];

// tipo_estado_verifica table
tipo_estado_verifica_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo estado de verificacion' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_estado_verifica_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo estado de verificacion' table."];
tipo_estado_verifica_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo estado de verificacion' table."];
tipo_estado_verifica_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo estado de verificacion' table."];
tipo_estado_verifica_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo estado de verificacion' table."];

tipo_estado_verifica_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo estado de verificacion' table."];
tipo_estado_verifica_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo estado de verificacion' table."];
tipo_estado_verifica_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo estado de verificacion' table."];
tipo_estado_verifica_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo estado de verificacion' table, regardless of their owner."];

tipo_estado_verifica_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo estado de verificacion' table."];
tipo_estado_verifica_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo estado de verificacion' table."];
tipo_estado_verifica_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo estado de verificacion' table."];
tipo_estado_verifica_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo estado de verificacion' table."];

// tipo_mtto table
tipo_mtto_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo de mantenimiento' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_mtto_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo de mantenimiento' table."];
tipo_mtto_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo de mantenimiento' table."];
tipo_mtto_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo de mantenimiento' table."];
tipo_mtto_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo de mantenimiento' table."];

tipo_mtto_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo de mantenimiento' table."];
tipo_mtto_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo de mantenimiento' table."];
tipo_mtto_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo de mantenimiento' table."];
tipo_mtto_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo de mantenimiento' table, regardless of their owner."];

tipo_mtto_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo de mantenimiento' table."];
tipo_mtto_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo de mantenimiento' table."];
tipo_mtto_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo de mantenimiento' table."];
tipo_mtto_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo de mantenimiento' table."];

// tipo_calibracion table
tipo_calibracion_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo calibracion' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_calibracion_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo calibracion' table."];
tipo_calibracion_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo calibracion' table."];
tipo_calibracion_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo calibracion' table."];
tipo_calibracion_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo calibracion' table."];

tipo_calibracion_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo calibracion' table."];
tipo_calibracion_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo calibracion' table."];
tipo_calibracion_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo calibracion' table."];
tipo_calibracion_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo calibracion' table, regardless of their owner."];

tipo_calibracion_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo calibracion' table."];
tipo_calibracion_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo calibracion' table."];
tipo_calibracion_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo calibracion' table."];
tipo_calibracion_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo calibracion' table."];

// tipo_accesorio table
tipo_accesorio_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo accesorio' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_accesorio_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo accesorio' table."];
tipo_accesorio_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo accesorio' table."];
tipo_accesorio_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo accesorio' table."];
tipo_accesorio_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo accesorio' table."];

tipo_accesorio_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo accesorio' table."];
tipo_accesorio_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo accesorio' table."];
tipo_accesorio_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo accesorio' table."];
tipo_accesorio_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo accesorio' table, regardless of their owner."];

tipo_accesorio_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo accesorio' table."];
tipo_accesorio_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo accesorio' table."];
tipo_accesorio_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo accesorio' table."];
tipo_accesorio_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo accesorio' table."];

// tipo_formatos table
tipo_formatos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo formatos' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_formatos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo formatos' table."];
tipo_formatos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo formatos' table."];
tipo_formatos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo formatos' table."];
tipo_formatos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo formatos' table."];

tipo_formatos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo formatos' table."];
tipo_formatos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo formatos' table."];
tipo_formatos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo formatos' table."];
tipo_formatos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo formatos' table, regardless of their owner."];

tipo_formatos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo formatos' table."];
tipo_formatos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo formatos' table."];
tipo_formatos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo formatos' table."];
tipo_formatos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo formatos' table."];

// dispo_detalles_tecnicos table
dispo_detalles_tecnicos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Detalles tecnicos' table. A member who adds a record to the table becomes the 'owner' of that record."];

dispo_detalles_tecnicos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Detalles tecnicos' table."];
dispo_detalles_tecnicos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Detalles tecnicos' table."];
dispo_detalles_tecnicos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Detalles tecnicos' table."];
dispo_detalles_tecnicos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Detalles tecnicos' table."];

dispo_detalles_tecnicos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Detalles tecnicos' table."];
dispo_detalles_tecnicos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Detalles tecnicos' table."];
dispo_detalles_tecnicos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Detalles tecnicos' table."];
dispo_detalles_tecnicos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Detalles tecnicos' table, regardless of their owner."];

dispo_detalles_tecnicos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Detalles tecnicos' table."];
dispo_detalles_tecnicos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Detalles tecnicos' table."];
dispo_detalles_tecnicos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Detalles tecnicos' table."];
dispo_detalles_tecnicos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Detalles tecnicos' table."];

// tipo_estado_observaciones table
tipo_estado_observaciones_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo estado observaciones' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_estado_observaciones_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo estado observaciones' table."];
tipo_estado_observaciones_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo estado observaciones' table."];
tipo_estado_observaciones_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo estado observaciones' table."];
tipo_estado_observaciones_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo estado observaciones' table."];

tipo_estado_observaciones_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo estado observaciones' table."];
tipo_estado_observaciones_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo estado observaciones' table."];
tipo_estado_observaciones_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo estado observaciones' table."];
tipo_estado_observaciones_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo estado observaciones' table, regardless of their owner."];

tipo_estado_observaciones_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo estado observaciones' table."];
tipo_estado_observaciones_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo estado observaciones' table."];
tipo_estado_observaciones_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo estado observaciones' table."];
tipo_estado_observaciones_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo estado observaciones' table."];

// movi_envio table
movi_envio_addTip=["",spacer+"This option allows all members of the group to add records to the 'Envio' table. A member who adds a record to the table becomes the 'owner' of that record."];

movi_envio_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Envio' table."];
movi_envio_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Envio' table."];
movi_envio_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Envio' table."];
movi_envio_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Envio' table."];

movi_envio_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Envio' table."];
movi_envio_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Envio' table."];
movi_envio_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Envio' table."];
movi_envio_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Envio' table, regardless of their owner."];

movi_envio_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Envio' table."];
movi_envio_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Envio' table."];
movi_envio_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Envio' table."];
movi_envio_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Envio' table."];

// movi_recepcion table
movi_recepcion_addTip=["",spacer+"This option allows all members of the group to add records to the 'Recepcion' table. A member who adds a record to the table becomes the 'owner' of that record."];

movi_recepcion_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Recepcion' table."];
movi_recepcion_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Recepcion' table."];
movi_recepcion_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Recepcion' table."];
movi_recepcion_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Recepcion' table."];

movi_recepcion_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Recepcion' table."];
movi_recepcion_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Recepcion' table."];
movi_recepcion_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Recepcion' table."];
movi_recepcion_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Recepcion' table, regardless of their owner."];

movi_recepcion_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Recepcion' table."];
movi_recepcion_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Recepcion' table."];
movi_recepcion_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Recepcion' table."];
movi_recepcion_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Recepcion' table."];

// tipo_fuera_servicio table
tipo_fuera_servicio_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo fuera servicio' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_fuera_servicio_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo fuera servicio' table."];
tipo_fuera_servicio_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo fuera servicio' table."];
tipo_fuera_servicio_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo fuera servicio' table."];
tipo_fuera_servicio_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo fuera servicio' table."];

tipo_fuera_servicio_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo fuera servicio' table."];
tipo_fuera_servicio_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo fuera servicio' table."];
tipo_fuera_servicio_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo fuera servicio' table."];
tipo_fuera_servicio_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo fuera servicio' table, regardless of their owner."];

tipo_fuera_servicio_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo fuera servicio' table."];
tipo_fuera_servicio_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo fuera servicio' table."];
tipo_fuera_servicio_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo fuera servicio' table."];
tipo_fuera_servicio_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo fuera servicio' table."];

// tipo_documento_ss table
tipo_documento_ss_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo de documento' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_documento_ss_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo de documento' table."];
tipo_documento_ss_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo de documento' table."];
tipo_documento_ss_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo de documento' table."];
tipo_documento_ss_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo de documento' table."];

tipo_documento_ss_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo de documento' table."];
tipo_documento_ss_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo de documento' table."];
tipo_documento_ss_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo de documento' table."];
tipo_documento_ss_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo de documento' table, regardless of their owner."];

tipo_documento_ss_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo de documento' table."];
tipo_documento_ss_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo de documento' table."];
tipo_documento_ss_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo de documento' table."];
tipo_documento_ss_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo de documento' table."];

// tipo_parentesco table
tipo_parentesco_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo de parentesco' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_parentesco_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo de parentesco' table."];
tipo_parentesco_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo de parentesco' table."];
tipo_parentesco_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo de parentesco' table."];
tipo_parentesco_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo de parentesco' table."];

tipo_parentesco_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo de parentesco' table."];
tipo_parentesco_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo de parentesco' table."];
tipo_parentesco_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo de parentesco' table."];
tipo_parentesco_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo de parentesco' table, regardless of their owner."];

tipo_parentesco_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo de parentesco' table."];
tipo_parentesco_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo de parentesco' table."];
tipo_parentesco_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo de parentesco' table."];
tipo_parentesco_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo de parentesco' table."];

// tipo_rh table
tipo_rh_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo rh' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_rh_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo rh' table."];
tipo_rh_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo rh' table."];
tipo_rh_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo rh' table."];
tipo_rh_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo rh' table."];

tipo_rh_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo rh' table."];
tipo_rh_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo rh' table."];
tipo_rh_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo rh' table."];
tipo_rh_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo rh' table, regardless of their owner."];

tipo_rh_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo rh' table."];
tipo_rh_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo rh' table."];
tipo_rh_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo rh' table."];
tipo_rh_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo rh' table."];

// accesorio_dispo_relacion table
accesorio_dispo_relacion_addTip=["",spacer+"This option allows all members of the group to add records to the 'Dispositivo relacionado' table. A member who adds a record to the table becomes the 'owner' of that record."];

accesorio_dispo_relacion_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Dispositivo relacionado' table."];
accesorio_dispo_relacion_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Dispositivo relacionado' table."];
accesorio_dispo_relacion_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Dispositivo relacionado' table."];
accesorio_dispo_relacion_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Dispositivo relacionado' table."];

accesorio_dispo_relacion_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Dispositivo relacionado' table."];
accesorio_dispo_relacion_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Dispositivo relacionado' table."];
accesorio_dispo_relacion_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Dispositivo relacionado' table."];
accesorio_dispo_relacion_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Dispositivo relacionado' table, regardless of their owner."];

accesorio_dispo_relacion_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Dispositivo relacionado' table."];
accesorio_dispo_relacion_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Dispositivo relacionado' table."];
accesorio_dispo_relacion_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Dispositivo relacionado' table."];
accesorio_dispo_relacion_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Dispositivo relacionado' table."];

// observaciones table
observaciones_addTip=["",spacer+"This option allows all members of the group to add records to the 'Observaciones' table. A member who adds a record to the table becomes the 'owner' of that record."];

observaciones_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Observaciones' table."];
observaciones_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Observaciones' table."];
observaciones_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Observaciones' table."];
observaciones_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Observaciones' table."];

observaciones_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Observaciones' table."];
observaciones_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Observaciones' table."];
observaciones_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Observaciones' table."];
observaciones_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Observaciones' table, regardless of their owner."];

observaciones_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Observaciones' table."];
observaciones_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Observaciones' table."];
observaciones_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Observaciones' table."];
observaciones_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Observaciones' table."];

// foto_observacion table
foto_observacion_addTip=["",spacer+"This option allows all members of the group to add records to the 'Fotos Observaciones' table. A member who adds a record to the table becomes the 'owner' of that record."];

foto_observacion_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Fotos Observaciones' table."];
foto_observacion_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Fotos Observaciones' table."];
foto_observacion_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Fotos Observaciones' table."];
foto_observacion_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Fotos Observaciones' table."];

foto_observacion_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Fotos Observaciones' table."];
foto_observacion_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Fotos Observaciones' table."];
foto_observacion_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Fotos Observaciones' table."];
foto_observacion_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Fotos Observaciones' table, regardless of their owner."];

foto_observacion_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Fotos Observaciones' table."];
foto_observacion_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Fotos Observaciones' table."];
foto_observacion_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Fotos Observaciones' table."];
foto_observacion_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Fotos Observaciones' table."];

// progreso table
progreso_addTip=["",spacer+"This option allows all members of the group to add records to the 'Progreso' table. A member who adds a record to the table becomes the 'owner' of that record."];

progreso_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Progreso' table."];
progreso_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Progreso' table."];
progreso_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Progreso' table."];
progreso_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Progreso' table."];

progreso_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Progreso' table."];
progreso_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Progreso' table."];
progreso_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Progreso' table."];
progreso_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Progreso' table, regardless of their owner."];

progreso_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Progreso' table."];
progreso_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Progreso' table."];
progreso_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Progreso' table."];
progreso_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Progreso' table."];

// tipo_estado_observa table
tipo_estado_observa_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo estado observa' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_estado_observa_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo estado observa' table."];
tipo_estado_observa_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo estado observa' table."];
tipo_estado_observa_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo estado observa' table."];
tipo_estado_observa_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo estado observa' table."];

tipo_estado_observa_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo estado observa' table."];
tipo_estado_observa_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo estado observa' table."];
tipo_estado_observa_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo estado observa' table."];
tipo_estado_observa_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo estado observa' table, regardless of their owner."];

tipo_estado_observa_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo estado observa' table."];
tipo_estado_observa_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo estado observa' table."];
tipo_estado_observa_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo estado observa' table."];
tipo_estado_observa_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo estado observa' table."];

// acceso_remoto table
acceso_remoto_addTip=["",spacer+"This option allows all members of the group to add records to the 'Acceso remoto' table. A member who adds a record to the table becomes the 'owner' of that record."];

acceso_remoto_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Acceso remoto' table."];
acceso_remoto_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Acceso remoto' table."];
acceso_remoto_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Acceso remoto' table."];
acceso_remoto_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Acceso remoto' table."];

acceso_remoto_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Acceso remoto' table."];
acceso_remoto_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Acceso remoto' table."];
acceso_remoto_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Acceso remoto' table."];
acceso_remoto_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Acceso remoto' table, regardless of their owner."];

acceso_remoto_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Acceso remoto' table."];
acceso_remoto_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Acceso remoto' table."];
acceso_remoto_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Acceso remoto' table."];
acceso_remoto_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Acceso remoto' table."];

// tipo_periodicidad table
tipo_periodicidad_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo periodicidad' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_periodicidad_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo periodicidad' table."];
tipo_periodicidad_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo periodicidad' table."];
tipo_periodicidad_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo periodicidad' table."];
tipo_periodicidad_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo periodicidad' table."];

tipo_periodicidad_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo periodicidad' table."];
tipo_periodicidad_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo periodicidad' table."];
tipo_periodicidad_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo periodicidad' table."];
tipo_periodicidad_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo periodicidad' table, regardless of their owner."];

tipo_periodicidad_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo periodicidad' table."];
tipo_periodicidad_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo periodicidad' table."];
tipo_periodicidad_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo periodicidad' table."];
tipo_periodicidad_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo periodicidad' table."];

// perfil table
perfil_addTip=["",spacer+"This option allows all members of the group to add records to the 'Perfil' table. A member who adds a record to the table becomes the 'owner' of that record."];

perfil_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Perfil' table."];
perfil_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Perfil' table."];
perfil_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Perfil' table."];
perfil_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Perfil' table."];

perfil_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Perfil' table."];
perfil_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Perfil' table."];
perfil_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Perfil' table."];
perfil_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Perfil' table, regardless of their owner."];

perfil_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Perfil' table."];
perfil_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Perfil' table."];
perfil_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Perfil' table."];
perfil_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Perfil' table."];

// consentimieto table
consentimieto_addTip=["",spacer+"This option allows all members of the group to add records to the 'Consentimieto' table. A member who adds a record to the table becomes the 'owner' of that record."];

consentimieto_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Consentimieto' table."];
consentimieto_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Consentimieto' table."];
consentimieto_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Consentimieto' table."];
consentimieto_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Consentimieto' table."];

consentimieto_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Consentimieto' table."];
consentimieto_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Consentimieto' table."];
consentimieto_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Consentimieto' table."];
consentimieto_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Consentimieto' table, regardless of their owner."];

consentimieto_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Consentimieto' table."];
consentimieto_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Consentimieto' table."];
consentimieto_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Consentimieto' table."];
consentimieto_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Consentimieto' table."];

// perfil_familia table
perfil_familia_addTip=["",spacer+"This option allows all members of the group to add records to the 'Familia' table. A member who adds a record to the table becomes the 'owner' of that record."];

perfil_familia_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Familia' table."];
perfil_familia_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Familia' table."];
perfil_familia_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Familia' table."];
perfil_familia_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Familia' table."];

perfil_familia_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Familia' table."];
perfil_familia_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Familia' table."];
perfil_familia_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Familia' table."];
perfil_familia_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Familia' table, regardless of their owner."];

perfil_familia_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Familia' table."];
perfil_familia_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Familia' table."];
perfil_familia_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Familia' table."];
perfil_familia_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Familia' table."];

// perfil_soportes table
perfil_soportes_addTip=["",spacer+"This option allows all members of the group to add records to the 'Soportes Perfil' table. A member who adds a record to the table becomes the 'owner' of that record."];

perfil_soportes_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Soportes Perfil' table."];
perfil_soportes_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Soportes Perfil' table."];
perfil_soportes_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Soportes Perfil' table."];
perfil_soportes_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Soportes Perfil' table."];

perfil_soportes_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Soportes Perfil' table."];
perfil_soportes_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Soportes Perfil' table."];
perfil_soportes_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Soportes Perfil' table."];
perfil_soportes_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Soportes Perfil' table, regardless of their owner."];

perfil_soportes_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Soportes Perfil' table."];
perfil_soportes_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Soportes Perfil' table."];
perfil_soportes_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Soportes Perfil' table."];
perfil_soportes_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Soportes Perfil' table."];

// seguridad_social table
seguridad_social_addTip=["",spacer+"This option allows all members of the group to add records to the 'Soportes SS' table. A member who adds a record to the table becomes the 'owner' of that record."];

seguridad_social_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Soportes SS' table."];
seguridad_social_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Soportes SS' table."];
seguridad_social_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Soportes SS' table."];
seguridad_social_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Soportes SS' table."];

seguridad_social_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Soportes SS' table."];
seguridad_social_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Soportes SS' table."];
seguridad_social_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Soportes SS' table."];
seguridad_social_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Soportes SS' table, regardless of their owner."];

seguridad_social_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Soportes SS' table."];
seguridad_social_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Soportes SS' table."];
seguridad_social_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Soportes SS' table."];
seguridad_social_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Soportes SS' table."];

// costos_mtto table
costos_mtto_addTip=["",spacer+"This option allows all members of the group to add records to the 'Costos en mantenimiento' table. A member who adds a record to the table becomes the 'owner' of that record."];

costos_mtto_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Costos en mantenimiento' table."];
costos_mtto_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Costos en mantenimiento' table."];
costos_mtto_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Costos en mantenimiento' table."];
costos_mtto_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Costos en mantenimiento' table."];

costos_mtto_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Costos en mantenimiento' table."];
costos_mtto_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Costos en mantenimiento' table."];
costos_mtto_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Costos en mantenimiento' table."];
costos_mtto_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Costos en mantenimiento' table, regardless of their owner."];

costos_mtto_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Costos en mantenimiento' table."];
costos_mtto_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Costos en mantenimiento' table."];
costos_mtto_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Costos en mantenimiento' table."];
costos_mtto_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Costos en mantenimiento' table."];

// tipo_costo table
tipo_costo_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo costo' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_costo_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo costo' table."];
tipo_costo_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo costo' table."];
tipo_costo_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo costo' table."];
tipo_costo_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo costo' table."];

tipo_costo_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo costo' table."];
tipo_costo_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo costo' table."];
tipo_costo_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo costo' table."];
tipo_costo_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo costo' table, regardless of their owner."];

tipo_costo_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo costo' table."];
tipo_costo_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo costo' table."];
tipo_costo_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo costo' table."];
tipo_costo_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo costo' table."];

// doc_mtto table
doc_mtto_addTip=["",spacer+"This option allows all members of the group to add records to the 'Doc mtto' table. A member who adds a record to the table becomes the 'owner' of that record."];

doc_mtto_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Doc mtto' table."];
doc_mtto_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Doc mtto' table."];
doc_mtto_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Doc mtto' table."];
doc_mtto_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Doc mtto' table."];

doc_mtto_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Doc mtto' table."];
doc_mtto_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Doc mtto' table."];
doc_mtto_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Doc mtto' table."];
doc_mtto_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Doc mtto' table, regardless of their owner."];

doc_mtto_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Doc mtto' table."];
doc_mtto_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Doc mtto' table."];
doc_mtto_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Doc mtto' table."];
doc_mtto_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Doc mtto' table."];

// biomedicos table
biomedicos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Biomedicos' table. A member who adds a record to the table becomes the 'owner' of that record."];

biomedicos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Biomedicos' table."];
biomedicos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Biomedicos' table."];
biomedicos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Biomedicos' table."];
biomedicos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Biomedicos' table."];

biomedicos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Biomedicos' table."];
biomedicos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Biomedicos' table."];
biomedicos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Biomedicos' table."];
biomedicos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Biomedicos' table, regardless of their owner."];

biomedicos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Biomedicos' table."];
biomedicos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Biomedicos' table."];
biomedicos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Biomedicos' table."];
biomedicos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Biomedicos' table."];

// tipo_clasifica_riesgo table
tipo_clasifica_riesgo_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo clasifica riesgo' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_clasifica_riesgo_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo clasifica riesgo' table."];
tipo_clasifica_riesgo_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo clasifica riesgo' table."];
tipo_clasifica_riesgo_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo clasifica riesgo' table."];
tipo_clasifica_riesgo_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo clasifica riesgo' table."];

tipo_clasifica_riesgo_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo clasifica riesgo' table."];
tipo_clasifica_riesgo_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo clasifica riesgo' table."];
tipo_clasifica_riesgo_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo clasifica riesgo' table."];
tipo_clasifica_riesgo_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo clasifica riesgo' table, regardless of their owner."];

tipo_clasifica_riesgo_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo clasifica riesgo' table."];
tipo_clasifica_riesgo_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo clasifica riesgo' table."];
tipo_clasifica_riesgo_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo clasifica riesgo' table."];
tipo_clasifica_riesgo_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo clasifica riesgo' table."];

// programa_mtto table
programa_mtto_addTip=["",spacer+"This option allows all members of the group to add records to the 'Programa mtto' table. A member who adds a record to the table becomes the 'owner' of that record."];

programa_mtto_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Programa mtto' table."];
programa_mtto_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Programa mtto' table."];
programa_mtto_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Programa mtto' table."];
programa_mtto_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Programa mtto' table."];

programa_mtto_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Programa mtto' table."];
programa_mtto_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Programa mtto' table."];
programa_mtto_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Programa mtto' table."];
programa_mtto_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Programa mtto' table, regardless of their owner."];

programa_mtto_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Programa mtto' table."];
programa_mtto_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Programa mtto' table."];
programa_mtto_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Programa mtto' table."];
programa_mtto_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Programa mtto' table."];

// cronograma_mtto table
cronograma_mtto_addTip=["",spacer+"This option allows all members of the group to add records to the 'Cronograma mtto' table. A member who adds a record to the table becomes the 'owner' of that record."];

cronograma_mtto_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Cronograma mtto' table."];
cronograma_mtto_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Cronograma mtto' table."];
cronograma_mtto_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Cronograma mtto' table."];
cronograma_mtto_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Cronograma mtto' table."];

cronograma_mtto_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Cronograma mtto' table."];
cronograma_mtto_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Cronograma mtto' table."];
cronograma_mtto_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Cronograma mtto' table."];
cronograma_mtto_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Cronograma mtto' table, regardless of their owner."];

cronograma_mtto_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Cronograma mtto' table."];
cronograma_mtto_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Cronograma mtto' table."];
cronograma_mtto_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Cronograma mtto' table."];
cronograma_mtto_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Cronograma mtto' table."];

// compras table
compras_addTip=["",spacer+"This option allows all members of the group to add records to the 'Ingreso / Salida' table. A member who adds a record to the table becomes the 'owner' of that record."];

compras_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Ingreso / Salida' table."];
compras_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Ingreso / Salida' table."];
compras_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Ingreso / Salida' table."];
compras_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Ingreso / Salida' table."];

compras_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Ingreso / Salida' table."];
compras_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Ingreso / Salida' table."];
compras_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Ingreso / Salida' table."];
compras_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Ingreso / Salida' table, regardless of their owner."];

compras_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Ingreso / Salida' table."];
compras_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Ingreso / Salida' table."];
compras_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Ingreso / Salida' table."];
compras_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Ingreso / Salida' table."];

// tipo_estado_compra table
tipo_estado_compra_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo estado compra' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_estado_compra_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo estado compra' table."];
tipo_estado_compra_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo estado compra' table."];
tipo_estado_compra_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo estado compra' table."];
tipo_estado_compra_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo estado compra' table."];

tipo_estado_compra_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo estado compra' table."];
tipo_estado_compra_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo estado compra' table."];
tipo_estado_compra_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo estado compra' table."];
tipo_estado_compra_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo estado compra' table, regardless of their owner."];

tipo_estado_compra_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo estado compra' table."];
tipo_estado_compra_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo estado compra' table."];
tipo_estado_compra_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo estado compra' table."];
tipo_estado_compra_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo estado compra' table."];

// cantidad_dispomedico table
cantidad_dispomedico_addTip=["",spacer+"This option allows all members of the group to add records to the 'Dispositivos Biomedicos Nuevos' table. A member who adds a record to the table becomes the 'owner' of that record."];

cantidad_dispomedico_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Dispositivos Biomedicos Nuevos' table."];
cantidad_dispomedico_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Dispositivos Biomedicos Nuevos' table."];
cantidad_dispomedico_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Dispositivos Biomedicos Nuevos' table."];
cantidad_dispomedico_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Dispositivos Biomedicos Nuevos' table."];

cantidad_dispomedico_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Dispositivos Biomedicos Nuevos' table."];
cantidad_dispomedico_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Dispositivos Biomedicos Nuevos' table."];
cantidad_dispomedico_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Dispositivos Biomedicos Nuevos' table."];
cantidad_dispomedico_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Dispositivos Biomedicos Nuevos' table, regardless of their owner."];

cantidad_dispomedico_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Dispositivos Biomedicos Nuevos' table."];
cantidad_dispomedico_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Dispositivos Biomedicos Nuevos' table."];
cantidad_dispomedico_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Dispositivos Biomedicos Nuevos' table."];
cantidad_dispomedico_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Dispositivos Biomedicos Nuevos' table."];

// cantidad_articulos table
cantidad_articulos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Articulos Nuevos' table. A member who adds a record to the table becomes the 'owner' of that record."];

cantidad_articulos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Articulos Nuevos' table."];
cantidad_articulos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Articulos Nuevos' table."];
cantidad_articulos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Articulos Nuevos' table."];
cantidad_articulos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Articulos Nuevos' table."];

cantidad_articulos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Articulos Nuevos' table."];
cantidad_articulos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Articulos Nuevos' table."];
cantidad_articulos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Articulos Nuevos' table."];
cantidad_articulos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Articulos Nuevos' table, regardless of their owner."];

cantidad_articulos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Articulos Nuevos' table."];
cantidad_articulos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Articulos Nuevos' table."];
cantidad_articulos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Articulos Nuevos' table."];
cantidad_articulos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Articulos Nuevos' table."];

// cantidad_mobiliario table
cantidad_mobiliario_addTip=["",spacer+"This option allows all members of the group to add records to the 'Mobiliario Nuevo' table. A member who adds a record to the table becomes the 'owner' of that record."];

cantidad_mobiliario_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Mobiliario Nuevo' table."];
cantidad_mobiliario_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Mobiliario Nuevo' table."];
cantidad_mobiliario_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Mobiliario Nuevo' table."];
cantidad_mobiliario_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Mobiliario Nuevo' table."];

cantidad_mobiliario_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Mobiliario Nuevo' table."];
cantidad_mobiliario_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Mobiliario Nuevo' table."];
cantidad_mobiliario_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Mobiliario Nuevo' table."];
cantidad_mobiliario_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Mobiliario Nuevo' table, regardless of their owner."];

cantidad_mobiliario_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Mobiliario Nuevo' table."];
cantidad_mobiliario_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Mobiliario Nuevo' table."];
cantidad_mobiliario_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Mobiliario Nuevo' table."];
cantidad_mobiliario_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Mobiliario Nuevo' table."];

// compra_dispo table
compra_dispo_addTip=["",spacer+"This option allows all members of the group to add records to the 'Dispo Biomedicos Comprados' table. A member who adds a record to the table becomes the 'owner' of that record."];

compra_dispo_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Dispo Biomedicos Comprados' table."];
compra_dispo_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Dispo Biomedicos Comprados' table."];
compra_dispo_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Dispo Biomedicos Comprados' table."];
compra_dispo_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Dispo Biomedicos Comprados' table."];

compra_dispo_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Dispo Biomedicos Comprados' table."];
compra_dispo_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Dispo Biomedicos Comprados' table."];
compra_dispo_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Dispo Biomedicos Comprados' table."];
compra_dispo_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Dispo Biomedicos Comprados' table, regardless of their owner."];

compra_dispo_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Dispo Biomedicos Comprados' table."];
compra_dispo_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Dispo Biomedicos Comprados' table."];
compra_dispo_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Dispo Biomedicos Comprados' table."];
compra_dispo_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Dispo Biomedicos Comprados' table."];

// articulos table
articulos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Articulos' table. A member who adds a record to the table becomes the 'owner' of that record."];

articulos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Articulos' table."];
articulos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Articulos' table."];
articulos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Articulos' table."];
articulos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Articulos' table."];

articulos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Articulos' table."];
articulos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Articulos' table."];
articulos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Articulos' table."];
articulos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Articulos' table, regardless of their owner."];

articulos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Articulos' table."];
articulos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Articulos' table."];
articulos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Articulos' table."];
articulos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Articulos' table."];

// cofig table
cofig_addTip=["",spacer+"This option allows all members of the group to add records to the 'CONFIG' table. A member who adds a record to the table becomes the 'owner' of that record."];

cofig_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'CONFIG' table."];
cofig_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'CONFIG' table."];
cofig_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'CONFIG' table."];
cofig_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'CONFIG' table."];

cofig_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'CONFIG' table."];
cofig_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'CONFIG' table."];
cofig_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'CONFIG' table."];
cofig_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'CONFIG' table, regardless of their owner."];

cofig_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'CONFIG' table."];
cofig_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'CONFIG' table."];
cofig_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'CONFIG' table."];
cofig_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'CONFIG' table."];

// marca_presetacion table
marca_presetacion_addTip=["",spacer+"This option allows all members of the group to add records to the 'Modelo presetacion' table. A member who adds a record to the table becomes the 'owner' of that record."];

marca_presetacion_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Modelo presetacion' table."];
marca_presetacion_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Modelo presetacion' table."];
marca_presetacion_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Modelo presetacion' table."];
marca_presetacion_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Modelo presetacion' table."];

marca_presetacion_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Modelo presetacion' table."];
marca_presetacion_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Modelo presetacion' table."];
marca_presetacion_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Modelo presetacion' table."];
marca_presetacion_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Modelo presetacion' table, regardless of their owner."];

marca_presetacion_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Modelo presetacion' table."];
marca_presetacion_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Modelo presetacion' table."];
marca_presetacion_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Modelo presetacion' table."];
marca_presetacion_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Modelo presetacion' table."];

// tipo_document_grupo table
tipo_document_grupo_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo grupo documento' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_document_grupo_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo grupo documento' table."];
tipo_document_grupo_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo grupo documento' table."];
tipo_document_grupo_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo grupo documento' table."];
tipo_document_grupo_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo grupo documento' table."];

tipo_document_grupo_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo grupo documento' table."];
tipo_document_grupo_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo grupo documento' table."];
tipo_document_grupo_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo grupo documento' table."];
tipo_document_grupo_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo grupo documento' table, regardless of their owner."];

tipo_document_grupo_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo grupo documento' table."];
tipo_document_grupo_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo grupo documento' table."];
tipo_document_grupo_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo grupo documento' table."];
tipo_document_grupo_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo grupo documento' table."];

// tipo_pago table
tipo_pago_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo pago' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_pago_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo pago' table."];
tipo_pago_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo pago' table."];
tipo_pago_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo pago' table."];
tipo_pago_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo pago' table."];

tipo_pago_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo pago' table."];
tipo_pago_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo pago' table."];
tipo_pago_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo pago' table."];
tipo_pago_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo pago' table, regardless of their owner."];

tipo_pago_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo pago' table."];
tipo_pago_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo pago' table."];
tipo_pago_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo pago' table."];
tipo_pago_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo pago' table."];

// tipo_compra table
tipo_compra_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo compra' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_compra_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo compra' table."];
tipo_compra_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo compra' table."];
tipo_compra_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo compra' table."];
tipo_compra_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo compra' table."];

tipo_compra_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo compra' table."];
tipo_compra_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo compra' table."];
tipo_compra_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo compra' table."];
tipo_compra_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo compra' table, regardless of their owner."];

tipo_compra_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo compra' table."];
tipo_compra_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo compra' table."];
tipo_compra_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo compra' table."];
tipo_compra_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo compra' table."];

// articulos_familia table
articulos_familia_addTip=["",spacer+"This option allows all members of the group to add records to the 'Articulos familia' table. A member who adds a record to the table becomes the 'owner' of that record."];

articulos_familia_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Articulos familia' table."];
articulos_familia_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Articulos familia' table."];
articulos_familia_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Articulos familia' table."];
articulos_familia_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Articulos familia' table."];

articulos_familia_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Articulos familia' table."];
articulos_familia_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Articulos familia' table."];
articulos_familia_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Articulos familia' table."];
articulos_familia_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Articulos familia' table, regardless of their owner."];

articulos_familia_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Articulos familia' table."];
articulos_familia_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Articulos familia' table."];
articulos_familia_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Articulos familia' table."];
articulos_familia_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Articulos familia' table."];

// articulo_codigo_proveedor table
articulo_codigo_proveedor_addTip=["",spacer+"This option allows all members of the group to add records to the 'Articulo codigo proveedor' table. A member who adds a record to the table becomes the 'owner' of that record."];

articulo_codigo_proveedor_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Articulo codigo proveedor' table."];
articulo_codigo_proveedor_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Articulo codigo proveedor' table."];
articulo_codigo_proveedor_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Articulo codigo proveedor' table."];
articulo_codigo_proveedor_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Articulo codigo proveedor' table."];

articulo_codigo_proveedor_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Articulo codigo proveedor' table."];
articulo_codigo_proveedor_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Articulo codigo proveedor' table."];
articulo_codigo_proveedor_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Articulo codigo proveedor' table."];
articulo_codigo_proveedor_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Articulo codigo proveedor' table, regardless of their owner."];

articulo_codigo_proveedor_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Articulo codigo proveedor' table."];
articulo_codigo_proveedor_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Articulo codigo proveedor' table."];
articulo_codigo_proveedor_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Articulo codigo proveedor' table."];
articulo_codigo_proveedor_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Articulo codigo proveedor' table."];

// tipo_unidad_medida table
tipo_unidad_medida_addTip=["",spacer+"This option allows all members of the group to add records to the 'Tipo unidad medida' table. A member who adds a record to the table becomes the 'owner' of that record."];

tipo_unidad_medida_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Tipo unidad medida' table."];
tipo_unidad_medida_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Tipo unidad medida' table."];
tipo_unidad_medida_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Tipo unidad medida' table."];
tipo_unidad_medida_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Tipo unidad medida' table."];

tipo_unidad_medida_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Tipo unidad medida' table."];
tipo_unidad_medida_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Tipo unidad medida' table."];
tipo_unidad_medida_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Tipo unidad medida' table."];
tipo_unidad_medida_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Tipo unidad medida' table, regardless of their owner."];

tipo_unidad_medida_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Tipo unidad medida' table."];
tipo_unidad_medida_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Tipo unidad medida' table."];
tipo_unidad_medida_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Tipo unidad medida' table."];
tipo_unidad_medida_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Tipo unidad medida' table."];

// genera_documentos table
genera_documentos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Genera documentos' table. A member who adds a record to the table becomes the 'owner' of that record."];

genera_documentos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Genera documentos' table."];
genera_documentos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Genera documentos' table."];
genera_documentos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Genera documentos' table."];
genera_documentos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Genera documentos' table."];

genera_documentos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Genera documentos' table."];
genera_documentos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Genera documentos' table."];
genera_documentos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Genera documentos' table."];
genera_documentos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Genera documentos' table, regardless of their owner."];

genera_documentos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Genera documentos' table."];
genera_documentos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Genera documentos' table."];
genera_documentos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Genera documentos' table."];
genera_documentos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Genera documentos' table."];

// verificacion_articulos table
verificacion_articulos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Verificacion' table. A member who adds a record to the table becomes the 'owner' of that record."];

verificacion_articulos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Verificacion' table."];
verificacion_articulos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Verificacion' table."];
verificacion_articulos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Verificacion' table."];
verificacion_articulos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Verificacion' table."];

verificacion_articulos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Verificacion' table."];
verificacion_articulos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Verificacion' table."];
verificacion_articulos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Verificacion' table."];
verificacion_articulos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Verificacion' table, regardless of their owner."];

verificacion_articulos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Verificacion' table."];
verificacion_articulos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Verificacion' table."];
verificacion_articulos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Verificacion' table."];
verificacion_articulos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Verificacion' table."];

// movimientos_articulos table
movimientos_articulos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Movimientos' table. A member who adds a record to the table becomes the 'owner' of that record."];

movimientos_articulos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Movimientos' table."];
movimientos_articulos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Movimientos' table."];
movimientos_articulos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Movimientos' table."];
movimientos_articulos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Movimientos' table."];

movimientos_articulos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Movimientos' table."];
movimientos_articulos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Movimientos' table."];
movimientos_articulos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Movimientos' table."];
movimientos_articulos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Movimientos' table, regardless of their owner."];

movimientos_articulos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Movimientos' table."];
movimientos_articulos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Movimientos' table."];
movimientos_articulos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Movimientos' table."];
movimientos_articulos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Movimientos' table."];

// movi_envio_articulo table
movi_envio_articulo_addTip=["",spacer+"This option allows all members of the group to add records to the 'Envio' table. A member who adds a record to the table becomes the 'owner' of that record."];

movi_envio_articulo_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Envio' table."];
movi_envio_articulo_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Envio' table."];
movi_envio_articulo_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Envio' table."];
movi_envio_articulo_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Envio' table."];

movi_envio_articulo_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Envio' table."];
movi_envio_articulo_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Envio' table."];
movi_envio_articulo_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Envio' table."];
movi_envio_articulo_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Envio' table, regardless of their owner."];

movi_envio_articulo_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Envio' table."];
movi_envio_articulo_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Envio' table."];
movi_envio_articulo_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Envio' table."];
movi_envio_articulo_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Envio' table."];

// movi_recepcion_articulos table
movi_recepcion_articulos_addTip=["",spacer+"This option allows all members of the group to add records to the 'Recepcion' table. A member who adds a record to the table becomes the 'owner' of that record."];

movi_recepcion_articulos_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Recepcion' table."];
movi_recepcion_articulos_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Recepcion' table."];
movi_recepcion_articulos_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Recepcion' table."];
movi_recepcion_articulos_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Recepcion' table."];

movi_recepcion_articulos_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Recepcion' table."];
movi_recepcion_articulos_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Recepcion' table."];
movi_recepcion_articulos_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Recepcion' table."];
movi_recepcion_articulos_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Recepcion' table, regardless of their owner."];

movi_recepcion_articulos_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Recepcion' table."];
movi_recepcion_articulos_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Recepcion' table."];
movi_recepcion_articulos_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Recepcion' table."];
movi_recepcion_articulos_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Recepcion' table."];

// ubicacion_articulo table
ubicacion_articulo_addTip=["",spacer+"This option allows all members of the group to add records to the 'Ubicacion articulo' table. A member who adds a record to the table becomes the 'owner' of that record."];

ubicacion_articulo_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Ubicacion articulo' table."];
ubicacion_articulo_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Ubicacion articulo' table."];
ubicacion_articulo_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Ubicacion articulo' table."];
ubicacion_articulo_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Ubicacion articulo' table."];

ubicacion_articulo_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Ubicacion articulo' table."];
ubicacion_articulo_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Ubicacion articulo' table."];
ubicacion_articulo_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Ubicacion articulo' table."];
ubicacion_articulo_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Ubicacion articulo' table, regardless of their owner."];

ubicacion_articulo_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Ubicacion articulo' table."];
ubicacion_articulo_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Ubicacion articulo' table."];
ubicacion_articulo_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Ubicacion articulo' table."];
ubicacion_articulo_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Ubicacion articulo' table."];

// ubicacion_mobiliario table
ubicacion_mobiliario_addTip=["",spacer+"This option allows all members of the group to add records to the 'Ubicacion mobiliario' table. A member who adds a record to the table becomes the 'owner' of that record."];

ubicacion_mobiliario_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Ubicacion mobiliario' table."];
ubicacion_mobiliario_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Ubicacion mobiliario' table."];
ubicacion_mobiliario_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Ubicacion mobiliario' table."];
ubicacion_mobiliario_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Ubicacion mobiliario' table."];

ubicacion_mobiliario_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Ubicacion mobiliario' table."];
ubicacion_mobiliario_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Ubicacion mobiliario' table."];
ubicacion_mobiliario_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Ubicacion mobiliario' table."];
ubicacion_mobiliario_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Ubicacion mobiliario' table, regardless of their owner."];

ubicacion_mobiliario_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Ubicacion mobiliario' table."];
ubicacion_mobiliario_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Ubicacion mobiliario' table."];
ubicacion_mobiliario_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Ubicacion mobiliario' table."];
ubicacion_mobiliario_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Ubicacion mobiliario' table."];

// precio_dispo_medico table
precio_dispo_medico_addTip=["",spacer+"This option allows all members of the group to add records to the 'Precio dispo medico' table. A member who adds a record to the table becomes the 'owner' of that record."];

precio_dispo_medico_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Precio dispo medico' table."];
precio_dispo_medico_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Precio dispo medico' table."];
precio_dispo_medico_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Precio dispo medico' table."];
precio_dispo_medico_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Precio dispo medico' table."];

precio_dispo_medico_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Precio dispo medico' table."];
precio_dispo_medico_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Precio dispo medico' table."];
precio_dispo_medico_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Precio dispo medico' table."];
precio_dispo_medico_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Precio dispo medico' table, regardless of their owner."];

precio_dispo_medico_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Precio dispo medico' table."];
precio_dispo_medico_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Precio dispo medico' table."];
precio_dispo_medico_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Precio dispo medico' table."];
precio_dispo_medico_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Precio dispo medico' table."];

// precio_articulo table
precio_articulo_addTip=["",spacer+"This option allows all members of the group to add records to the 'Precio articulo' table. A member who adds a record to the table becomes the 'owner' of that record."];

precio_articulo_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Precio articulo' table."];
precio_articulo_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Precio articulo' table."];
precio_articulo_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Precio articulo' table."];
precio_articulo_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Precio articulo' table."];

precio_articulo_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Precio articulo' table."];
precio_articulo_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Precio articulo' table."];
precio_articulo_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Precio articulo' table."];
precio_articulo_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Precio articulo' table, regardless of their owner."];

precio_articulo_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Precio articulo' table."];
precio_articulo_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Precio articulo' table."];
precio_articulo_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Precio articulo' table."];
precio_articulo_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Precio articulo' table."];

// precio_mobiliario table
precio_mobiliario_addTip=["",spacer+"This option allows all members of the group to add records to the 'Precio mobiliario' table. A member who adds a record to the table becomes the 'owner' of that record."];

precio_mobiliario_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Precio mobiliario' table."];
precio_mobiliario_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Precio mobiliario' table."];
precio_mobiliario_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Precio mobiliario' table."];
precio_mobiliario_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Precio mobiliario' table."];

precio_mobiliario_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Precio mobiliario' table."];
precio_mobiliario_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Precio mobiliario' table."];
precio_mobiliario_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Precio mobiliario' table."];
precio_mobiliario_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Precio mobiliario' table, regardless of their owner."];

precio_mobiliario_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Precio mobiliario' table."];
precio_mobiliario_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Precio mobiliario' table."];
precio_mobiliario_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Precio mobiliario' table."];
precio_mobiliario_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Precio mobiliario' table."];

/*
	Style syntax:
	-------------
	[TitleColor,TextColor,TitleBgColor,TextBgColor,TitleBgImag,TextBgImag,TitleTextAlign,
	TextTextAlign,TitleFontFace,TextFontFace, TipPosition, StickyStyle, TitleFontSize,
	TextFontSize, Width, Height, BorderSize, PadTextArea, CoordinateX , CoordinateY,
	TransitionNumber, TransitionDuration, TransparencyLevel ,ShadowType, ShadowColor]

*/

toolTipStyle=["white","#00008B","#000099","#E6E6FA","","images/helpBg.gif","","","","\"Trebuchet MS\", sans-serif","","","","3",400,"",1,2,10,10,51,1,0,"",""];

applyCssFilter();
