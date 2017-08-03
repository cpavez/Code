@extends('ufroLayout.index')

@section('formulario')
    <div class="modal">
        <div class="modal__container">
            <div class="modal__content">
                <p style="font-size: 20px;text-align: center;color: #fff;">SISTEMA DE REGISTRO ACTIVIDADES DE BECADOS DE ANESTESIA - UFRO</p>
<br>

                <form>
                    <ul class="form-list">
                        <li class="form-list__row">
                            <label>Nombre del Becado</label>
                            <select placeholder="Nombre del Becado" name="subject" id="subject_input" required="" style="background-color: #ed796c;">
                                <option disabled hidden selected >Seleccione</option>
                                <option>CRISTHIAN ANDRES PAVEZ FRANCO</option>
                                <option>VICTORIA NICOL ARANCIVIA FIGUEROA</option>
                            </select>
                        </li>
                        <li class="form-list__row">
                            <label>Cuenta Corriente</label>
                            <input type="number" name="" required="" style="background-color: #ee7f6f;"/>
                        </li>
                        <li class="form-list__row">
                            <div class="row paypal" style="border-bottom: 2px solid #f0f0f0;height: 60px;">
                                <div class="left">
                                    <input id="pp" type="checkbox" name="payment" style="min-height: 0px;" />
                                    <div class="radio"></div>
                                    <label for="pp">Paciente Recien Nacido</label>
                                </div>
                            </div>
                        </li>
                        <li class="form-list__row">
                            <label>Edad</label>
                            <div class="range range-info">
                                <input type="range" name="range" min="1" max="100" value="0" onchange="range.value=value">
                                <output id="range">0</output>
                            </div>
                        </li>
                        <li class="form-list__row">
                            <label>Genero</label>
                            <select placeholder="Nombre del Becado" name="subject" id="subject_input" required="" style="background-color: #ef8573;">
                                <option disabled hidden selected >Seleccione</option>
                                <option>MASCULINO</option>
                                <option>FEMENINO</option>
                            </select>
                        </li>
                        <li class="form-list__row">
                            <label>Diagnostico</label>
                            <textarea name="message" placeholder="" id="message_input" cols="30" rows="5" required="" style="background-color: #ef8874;"></textarea>
                        </li>
                        <li class="form-list__row">
                            <label>ASA</label>
                            <select placeholder="Nombre del Becado" name="subject" id="subject_input" required="" style="background-color: #f1927a;">
                                <option disabled hidden selected >Seleccione</option>
                                <option>ASA I</option>
                                <option>ASA II</option>
                                <option>ASA III</option>
                                <option>ASA IV</option>
                                <option>ASA V</option>
                                <option>ASA VI</option>
                            </select>
                        </li>
                        <li class="form-list__row">
                            <label>PABELLON</label>
                            <select placeholder="Nombre del Becado" name="subject" id="subject_input" required="" style="background-color: #f1957c;">
                                <option disabled hidden selected >Seleccione</option>
                                <option>URGENCIA</option>
                                <option>ELECTIVO PROGRAMADO</option>
                            </select>
                        </li>

                        <li class="form-list__row">
                            <label>CATEGORIA DEL PACIENTE</label>
                            <select placeholder="Nombre del Becado" name="subject" id="subject_input" required="" style="background-color: #f1957c;">
                                <option disabled hidden selected >Seleccione</option>
                                <option>Anestesia Pediatrica</option>
                                <option>Anestesia Obstétrica</option>
                                <option>Anestesia Traumatológica</option>
                                <option>Anestesia Urológica</option>
                                <option>Anestesia Neuroquirúrgica</option>
                                <option>Anestesia Cardiovascular</option>
                                <option>Anestesia Ambulatoria</option>
                                <option>Anestesia Oftalmológica</option>
                                <option>Anestesia Ginecológica</option>
                                <option>Anestesia General</option>
                                <option>Anestesia Tòrax</option>
                                <option>Intensivo</option>
                                <option>Otro</option>
                            </select>
                        </li>

                        <li class="form-list__row">
                            <label>PROCEDIMIENTO A REGISTRAR</label>
                            <select placeholder="Nombre del Becado" name="subject" id="subject_input" required="" style="background-color: #f1957c;">
                                <option disabled hidden selected >Seleccione</option>
                                <option>ANESTECIA GENERAL</option>
                                <option>ANESTECIA REGIONAL</option>
                                <option>PROCEDIMIENTO INVASIVO</option>
                                <option>INTERCONSULTA</option>
                                <option>OTRO</option>
                            </select>
                        </li>

                        <li class="form-list__row">
                            <label>ANESTESIOLOGO STAFF</label>
                            <select placeholder="Nombre del Becado" name="subject" id="subject_input" required="" style="background-color: #f1957c;">
                                <option disabled hidden selected >Seleccione</option>
                                <option>DOCENTE 1</option>
                                <option>DOCENTE 2</option>
                                <option>DOCENTE 3</option>
                                <option>DOCENTE 4</option>
                            </select>
                        </li>

                        <li>
                            <button type="submit" class="button">Pay Now</button>
                        </li>
                    </ul>
                </form>
            </div> <!-- END: .modal__content -->
        </div> <!-- END: .modal__container -->
    </div> <!-- END: .modal -->
@stop