<div class="box configcompañia">
    <h4 class="text-slate-500 text-2xl mb-4"><i class="fa-solid fa-building-circle-check mr-4"></i>Crear Compañia</h4>
    

    <form class="max-w-xl mx-auto">
    <div class="mb-5">
        <label for="type_document_identification_id" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Tipo Documento</label>
        <select id="type_document_identification_id" name="type_document_identification_id" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
    <div class="mb-5">
        <label for="identification_number" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Numero de Documento</label>
        <input type="number" id="identification_number" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Sin digito verificador" required />
    </div>
    <div class="mb-5">
        <label for="idsoftware" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">ID Software</label>
        <input type="number" id="idsoftware" name="idsoftware" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
    </div>
    <div class="mb-5">
        <label for="pinsoftware" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Pin Software</label>
        <input type="number" id="pinsoftware" name="pinsoftware" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
    </div>
    <div class="mb-5">
        <label for="nombrerazonsocial" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Nombre/Razon Social</label>
        <input type="text" id="nombrerazonsocial" name="nombrerazonsocial" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
    </div>
    <div class="mb-5">
        <label for="tipoorganizacion" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Tipo Organizacion</label>
        <select id="tipoorganizacion" name="tipoorganizacion" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="1">Persona Juridica</option>
            <option value="2">Persona Natural</option>
        </select>
    </div>
    <div class="mb-5">
        <label for="Obligaciones" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Obligaciones</label>
        <select id="Obligaciones" name="Obligaciones" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="1">Gran contribuyente</option>
            <option value="2">Autorretenedor</option>
            <option value="3">Agente de retencion en el impuesto sobre las ventas</option>
            <option value="4">Regimen simple de tributacion - Simple</option>
            <option value="4">No Responsable</option>
        </select>
    </div>
    <div class="mb-5">
        <label for="impuesto" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Impuesto</label>
        <select id="impuesto" name="impuesto" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="1">Ninguno</option>
            <option value="2">IVA</option>
            <option value="3">Impuesto Nacional al consumo</option>
        </select>
    </div>
    <div class="mb-5">
        <label for="regimen" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Regimen</label>
        <select id="regimen" name="regimen" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="1">Responsable de IVA</option>
            <option value="2">No Responsable de IVA</option>
        </select>
    </div>
    <div class="mb-5">
        <label for="email" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Correo electronico</label>
        <input type="email" id="email" name="email" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
    </div>
    <div class="mb-5">
        <label for="telefono" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Telefono</label>
        <input type="number" id="telefono" name="telefono" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
    </div>
    <div class="mb-5">
        <label for="departamento" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Departamento</label>
        <select id="departamento" name="departamento" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="1">Responsable de IVA</option>
            <option value="2">No Responsable de IVA</option>
        </select>
    </div>
    <div class="mb-5">
        <label for="Ciudad" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Ciudad</label>
        <select id="Ciudad" name="Ciudad" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option value="1">Responsable de IVA</option>
            <option value="2">No Responsable de IVA</option>
        </select>
    </div>
    <div class="mb-5">
        <label for="direccion" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Direccion</label>
        <input type="text" id="direccion" name="direccion" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
    </div>
    
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center ">Crear Compañia</button>
    </form>

</div>