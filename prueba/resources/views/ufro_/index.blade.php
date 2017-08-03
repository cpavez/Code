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
                            <!--<input type="range" class="range" name="range" min="1" max="100" value="0" onchange="range.value=value">
                            <output id="range">0</output>-->
                            <div class="item range more-slider-input-range more-styled-range" data-styled-element="range">
                                <input type="range" min="0" max="99" step="1" data-ng-model="_tmp.initialValue" data-ng-change="inputChanged(_tmp.initialValue)" class="ng-pristine ng-valid ng-not-empty ng-touched">
                            </div>
                            <label class="item item-input item-stacked-label more-slider-input-field" data-ng-if="::!field.properties.hide_value">
                                <input type="number" min="0" max="99" placeholder="" data-ng-model="_tmp.initialValue" data-ng-change="inputChanged(_tmp.initialValue)" class="ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-min ng-valid-max">
                            </label>
                        </li>
                        <li class="form-list__row">
                            <label>Diagnostico</label>
                            <textarea name="message" placeholder="" id="message_input" cols="30" rows="5" required="" style="background-color: #ef8874;"></textarea>
                        </li>
                        <li class="form-list__row">
                            <label>Card Number</label>
                            <div id="input--cc" class="creditcard-icon">
                                <input type="text" name="cc_number" required="" />
                            </div>
                        </li>
                        <li class="form-list__row form-list__row--inline">
                            <div>
                                <label>Expiration Date</label>
                                <div class="form-list__input-inline">
                                    <input type="text" name="cc_month" placeholder="MM"  pattern="\\d*" minlength="2" maxlength="2" required="" />
                                    <input type="text" name="cc_year" placeholder="YY"  pattern="\\d*" minlength="2" maxlength="2" required="" />
                                </div>
                            </div>
                            <div>
                                <label>
                                    CVC

                                    <a href="#cvv-modal" class="button--transparent modal-open button--info">
                                        <svg class="nc-icon glyph" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 16 16"><g> <path fill="#35a4fb" d="M8,0C3.6,0,0,3.6,0,8s3.6,8,8,8s8-3.6,8-8S12.4,0,8,0z M8,13c-0.6,0-1-0.4-1-1c0-0.6,0.4-1,1-1s1,0.4,1,1 C9,12.6,8.6,13,8,13z M9.5,8.4C9,8.7,9,8.8,9,9v1H7V9c0-1.3,0.8-1.9,1.4-2.3C8.9,6.4,9,6.3,9,6c0-0.6-0.4-1-1-1 C7.6,5,7.3,5.2,7.1,5.5L6.6,6.4l-1.7-1l0.5-0.9C5.9,3.6,6.9,3,8,3c1.7,0,3,1.3,3,3C11,7.4,10.1,8,9.5,8.4z"></path> </g></svg>
                                        <span class="visuallyhidden">What is CVV?</span>
                                    </a>
                                </label>
                                <input type="text" name="cc_cvc" placeholder="123" pattern="\\d*" minlength="3" maxlength="4" required="" />
                            </div>
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