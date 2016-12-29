<?php 
namespace InvitationBundle\Form\ParameterType;

interface ParameterTypeInterface {
    public function addField($form, $name, $TypeConfig);
}