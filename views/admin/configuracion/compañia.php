<div class="box configcompañia">
    <h4 class="text-slate-500 text-2xl mb-4"><i class="fa-solid fa-building-circle-check mr-4"></i>Crear Compañia</h4>
    <?php include __DIR__. "/../../templates/alertas.php"; ?>

    <form class="" action="/admin/configuracion/company" enctype="multipart/form-data" method="POST">
        <div class="max-w-screen-lg mx-auto grid md:grid-cols-6 gap-x-6"> 
            <div class="mb-5 col-span-3">
                <label for="typo_documento" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Tipo Documento</label>
                <select id="typo_documento" name="tipo_documento" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option value="1">Registro civil</option>
                    <option value="2">Tarjeta de identidad</option>
                    <option value="3">Cedula de ciudadania</option>
                    <option value="4">Tarjeta de extranjeria</option>
                    <option value="5">Cedula de extrangeria</option>
                    <option value="6">NIT</option>
                    <option value="7">Pasaporte</option>
                    <option value="8">Documento de identificacion extranjero</option>
                    <option value="9">NIT de otro pais</option>
                    <option value="10">NUIP</option>
                </select>
            </div>
            <div class="mb-5 col-span-3">
                <label for="numero_documento" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Numero de Documento</label>
                <input type="number" id="numero_documento" name="numero_documento" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Sin digito verificador" required />
            </div>
            <div class="mb-5 col-span-3">
                <label for="certificadoDigital" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Certificado Digital .p12</label>
                <input type="file" id="certificadoDigital" name="certificadoDigital" accept=".p12" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            </div>
            <div class="mb-5 col-span-3">
                <label for="password" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Password</label>
                <input type="text" id="password" name="password" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            </div>
            <div class="mb-5 col-span-3">
                <label for="idsoftware" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">ID Software</label>
                <input type="text" id="idsoftware" name="idsoftware" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            </div>
            <div class="mb-5 col-span-3">
                <label for="pinsoftware" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Pin Software</label>
                <input type="number" id="pinsoftware" name="pinsoftware" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            </div>
            <div class="mb-5 col-span-3">
                <label for="nombrerazonsocial" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Nombre/Razon Social</label>
                <input type="text" id="nombrerazonsocial" name="nombrerazonsocial" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            </div>
            <div class="mb-5 col-span-3">
                <label for="tipoorganizacion" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Tipo Organizacion</label>
                <select id="tipoorganizacion" name="tipoorganizacion" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option value="1">Persona Juridica</option>
                    <option value="2">Persona Natural</option>
                </select>
            </div>
            <div class="mb-5 col-span-3">
                <label for="Obligaciones" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Obligaciones</label>
                <select id="Obligaciones" name="obligaciones" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option value="7">Gran contribuyente</option>
                    <option value="9">Autorretenedor</option>
                    <option value="14">Agente de retencion en el impuesto sobre las ventas</option>
                    <option value="112">Regimen simple de tributacion - Simple</option>
                    <option value="117">No Responsable</option>
                </select>
            </div>
            <div class="mb-5 col-span-3">
                <label for="impuesto" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Impuesto</label>
                <select id="impuesto" name="impuesto" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option value="1">Ninguno</option>
                    <option value="1">IVA</option>
                    <option value="4">Impuesto Nacional al consumo</option>
                </select>
            </div>
            <div class="mb-5 col-span-3">
                <label for="regimen" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Regimen</label>
                <select id="regimen" name="regimen" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option value="1">Responsable de IVA</option>
                    <option value="2">No Responsable de IVA</option>
                </select>
            </div>
            <div class="mb-5 col-span-3">
                <label for="email" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Correo electronico</label>
                <input type="email" id="email" name="email" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            </div>
            <div class="mb-5 col-span-3">
                <label for="telefono" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Telefono</label>
                <input type="number" id="telefono" name="telefono" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            </div>
            <div class="mb-5 col-span-3">
                <label for="departamento" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Departamento</label>
                <select id="departamento" name="departamento" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    <option value="" disabled selected>-Seleccionar-</option>
                    <?php foreach($departments as $departamento): ?>
                        <option value="<?php echo $departamento->id;?>"><?php echo $departamento->name;?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-5 col-span-3">
                <label for="Ciudad" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Ciudad</label>
                <select id="Ciudad" name="ciudad" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    
                </select>
            </div>
            <div class="mb-5 col-span-3">
                <label for="direccion" class="block mb-2 text-xl font-medium text-gray-900 dark:text-white">Direccion</label>
                <input type="text" id="direccion" name="direccion" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
            </div>
            
            <div class="mb-5 col-span-3 flex items-center justify-center">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg px-8 py-4 text-center ">Crear Compañia</button>
            </div>
        </div> 
    </form>

    <table class="display responsive nowrap tabla mt-12" width="100%" id="tablaCompany">
      <thead>
          <tr class="text-xl">
              <th>id</th>
              <th>Nombre</th>
              <th>Documento</th>
              <th>Compañia ID</th>
              <th>Usuario ID</th>
              <th>Software - Token</th>
              <th class="accionesth">Acciones</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach($companies as $index => $value): ?>
          <tr class="text-xl"> 
              <td class=""><?php echo $index+1;?></td>        
              <td class="" ><?php echo $value->objuser->name;?></td>
              <td class=""><?php echo $value->identification_number.'-'.$value->dv;?></td>
              <td class="" ><?php echo $value->id;?></td>
              <td class="" ><?php echo $value->objuser->id;?></td>
              <td class="" >
                <p></p>
                <p><?php echo $value->objuser->api_token;?></p>
            </td>
              <td class="accionestd"><div class="acciones-btns" id="<?php echo $value->id;?>"><button class="btn-md btn-red eliminarCompany"><i class="fa-solid fa-trash-can"></i></button></div></td>
          </tr>
          <?php endforeach; ?>
      </tbody>
    </table>

</div>