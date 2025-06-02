<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pago;

class PagoSeeder extends Seeder
{
    public function run(): void
    {
        $pagos = [
            [
                'id_matricula' => 1,
                'monto' => 150.00,
                'fecha_pago' => '2025-01-15',
                'comprobante' => 'COM-001-2025',
                'metodo_pago' => 'efectivo',
                'estado' => 'completado',
                'observaciones' => 'Pago completo del primer mes'
            ],
            [
                'id_matricula' => 2,
                'monto' => 200.00,
                'fecha_pago' => '2025-01-20',
                'comprobante' => 'COM-002-2025',
                'metodo_pago' => 'tarjeta',
                'estado' => 'completado',
                'observaciones' => 'Pago con tarjeta de crédito'
            ],
            [
                'id_matricula' => 3,
                'monto' => 180.00,
                'fecha_pago' => '2025-02-01',
                'comprobante' => 'COM-003-2025',
                'metodo_pago' => 'transferencia',
                'estado' => 'completado',
                'observaciones' => 'Transferencia bancaria verificada'
            ],
            [
                'id_matricula' => 4,
                'monto' => 120.00,
                'fecha_pago' => '2025-02-10',
                'comprobante' => null,
                'metodo_pago' => 'efectivo',
                'estado' => 'pendiente',
                'observaciones' => 'Pago parcial, falta completar'
            ],
            [
                'id_matricula' => 5,
                'monto' => 300.00,
                'fecha_pago' => '2025-02-15',
                'comprobante' => 'COM-005-2025',
                'metodo_pago' => 'tarjeta',
                'estado' => 'completado',
                'observaciones' => 'Pago de curso preuniversitario'
            ],
            [
                'id_matricula' => 1,
                'monto' => 75.00,
                'fecha_pago' => '2025-03-01',
                'comprobante' => 'COM-006-2025',
                'metodo_pago' => 'efectivo',
                'estado' => 'completado',
                'observaciones' => 'Segunda cuota matrícula 1'
            ],
            [
                'id_matricula' => 2,
                'monto' => 90.00,
                'fecha_pago' => '2025-03-05',
                'comprobante' => 'COM-007-2025',
                'metodo_pago' => 'transferencia',
                'estado' => 'completado',
                'observaciones' => 'Cuota mensual marzo'
            ],
            [
                'id_matricula' => 3,
                'monto' => 200.00,
                'fecha_pago' => '2025-03-10',
                'comprobante' => null,
                'metodo_pago' => 'tarjeta',
                'estado' => 'pendiente',
                'observaciones' => 'Pago mensualidad marzo - en proceso'
            ]
        ];

        foreach ($pagos as $pago) {
            Pago::create($pago);
        }
    }
}