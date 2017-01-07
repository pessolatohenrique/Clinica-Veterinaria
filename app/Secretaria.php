<?php namespace ClinicaVeterinaria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Secretaria extends Model {
	public $timestamps = false;
    protected $fillable = ['cpf','nome','email','telefone','celular','dataAdmissao','horaEntrada','horaSaida'];
}
