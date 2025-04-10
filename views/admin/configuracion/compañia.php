<div class="box configcompañia">
    <h4 class="text-slate-500 text-2xl mb-4"><i class="fa-solid fa-building-circle-check mr-4"></i>Crear Compañia</h4>
    

    <form class="max-w-md mx-auto">
    <div class="mb-5">
        <label for="type_document_identification_id" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Tipo Documento</label>
        <select id="type_document_identification_id" name="type_document_identification_id" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
        <label for="identification_number" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Numero de Documento</label>
        <input type="number" id="identification_number" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@flowbite.com" required />
    </div>
    <div class="mb-5">
        <label for="password" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">ID Software</label>
        <input type="number" id="password" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
    </div>
    <div class="mb-5">
        <label for="repeat-password" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Pin Software</label>
        <input type="password" id="repeat-password" class="shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required />
    </div>
    
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-2.5 text-center ">Crear Compañia</button>
    </form>

</div>