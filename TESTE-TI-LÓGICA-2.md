SELECT b.nome AS banco, c.verba AS verba, MIN(co.data_inclusao) AS data_inclusao_minima, MAX(co.data_inclusao) AS data_inclusao_maxima, SUM(co.valor) AS valor_total_contratos
FROM Tb_banco b
INNER JOIN Tb_convenio c ON b.codigo = c.banco
INNER JOIN Tb_convenio_servico cs ON c.codigo = cs.convenio
INNER JOIN Tb_contrato co ON cs.codigo = co.convenio_servico
GROUP BY b.nome, c.verba
