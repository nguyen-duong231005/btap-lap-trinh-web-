SELECT 
    MONTH(pm.muon_luc) AS thang, 
    COUNT(*) AS tong_luot_muon
FROM phieu_muon pm
WHERE YEAR(pm.muon_luc) = YEAR(CURDATE())
GROUP BY MONTH(pm.muon_luc)
ORDER BY thang ASC;