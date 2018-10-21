from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

browser = webdriver.Safari()
browser.get("http://app.sct.gob.mx/sibuac_internet/ControllerUI?action=cmdEscogeRuta")

select = browser.find_element_by_name('edoOrigen')
options = select.find_elements_by_tag_name('option')
options[9].click()
time.sleep(1)

select = browser.find_element_by_name('ciudadOrigen')
options1 = select.find_elements_by_tag_name('option')
options1[5].click()
time.sleep(1)

select = browser.find_element_by_name('edoDestino')
options = select.find_elements_by_tag_name('option')
options[12].click()
time.sleep(1)

select = browser.find_element_by_name('ciudadDestino')
options = select.find_elements_by_tag_name('option')

for option in options:
    if option.get_attribute('value') == "12350":
        option.click()

time.sleep(1)
button = browser.find_element_by_xpath('//*[@id="headerEPN"]/table[3]/tbody/tr/td/table/tbody/tr[3]/td/table/tbody/tr[5]/td/a').click()
time.sleep(1)

select = browser.find_element_by_name('edoIntermedio1')
options = select.find_elements_by_tag_name('option')
options[17].click()
time.sleep(1)

select = browser.find_element_by_name('ciudadIntermedia1')
options = select.find_elements_by_tag_name('option')

for option in options:
    if option.get_attribute('value') == "17050":
        option.click()

time.sleep(1)

button = browser.find_element_by_xpath('//*[@id="headerEPN"]/table[3]/tbody/tr/td/table/tbody/tr[3]/td/table/tbody/tr[14]/td/a').click()

time.sleep(5)

rendimiento = browser.find_element_by_name('rendimiento')
rendimiento.clear()
rendimiento.send_keys("8.36")
time.sleep(1)
select = browser.find_element_by_name('combustible')
options = select.find_elements_by_tag_name('option')
options[1].click()
time.sleep(1)

select = browser.find_element_by_name('tamanioVehiculo')
options = select.find_elements_by_tag_name('option')

for option in options:
    if option.get_attribute('value') == "2":
        option.click()

time.sleep(1)

select = browser.find_element_by_name('desplazamiento')
options = select.find_elements_by_tag_name('option')

for option in options:
    if option.get_attribute('value') == "3":
        option.click()
time.sleep(1)
button = browser.find_element_by_xpath('//*[@id="headerEPN"]/table[3]/tbody/tr/td/table/tbody/tr[4]/td[2]/input').click()
time.sleep(1)

totalcasetas = browser.find_element_by_xpath('//*[@id="tContenido"]/tbody/tr[17]/td[5]').text
print("Costo Casetas: ", totalcasetas)
totalcomu = browser.find_element_by_xpath('//*[@id="tContenido"]/tbody/tr[19]/td[5]').text
print("Costo combustible: ", totalcomu)
total = browser.find_element_by_xpath('//*[@id="tContenido"]/tbody/tr[21]/td[5]').text
print("Costo total: ", total)
KM = browser.find_element_by_xpath('//*[@id="tContenido"]/tbody/tr[17]/td[2]').text
print("Kilometros: ", KM)
tiempo = browser.find_element_by_xpath('//*[@id="tContenido"]/tbody/tr[17]/td[3]').text
print("tiempo: ", tiempo)

table = browser.find_element_by_xpath("//*[@id='tContenido']").find_elements_by_tag_name('tr')

lista1 = []
lista2 = []

for i in range(2, len(table) - 11):
	lista1.append(table[i].find_elements_by_tag_name("td")[1].text)
	lista2.append(table[i].find_elements_by_tag_name("td")[5].text)

lista1 = set(lista1)
lista2 = set(lista2)


print("Número total de estados visitados:", len(list(set(lista1))), " estados")
print("Número total de casetas:", len(list(set(lista2))), " casetas")
