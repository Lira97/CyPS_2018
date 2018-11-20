from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import csv
import time

csv = open("alumnos.csv", "w")


browser = webdriver.Safari()
browser.get("http://10.49.71.125:3000/~certificatec/pronosticos")
rendimiento = browser.find_element_by_name('login[username]')
rendimiento.clear()
rendimiento.send_keys("ariel.garcia@itesm.mx")
rendimiento = browser.find_element_by_name('login[password]')
rendimiento.clear()
rendimiento.send_keys("1234")
button = browser.find_element_by_name('commit')
button.click()
time.sleep(1)
button = browser.find_element_by_xpath("//a[@href='/~certificatec/pronosticos/pronosticos']").click();
time.sleep(1)
button = browser.find_element_by_xpath('//*[@id="sidebar"]/ul[1]/li[5]/a').click();
time.sleep(1)

lista1 = []
lista2 = []
lista3 = []
lista4 = []
table = browser.find_element_by_xpath('//*[@id="candidatos_container"]').find_elements_by_tag_name('tr')

for i in range(0, len(table)):
	lista1.append(table[i].find_elements_by_tag_name("td")[0].text.encode('utf-8'))
	lista2.append(table[i].find_elements_by_tag_name("td")[1].text.encode('utf-8'))

for i in range(0, len(lista1)):
	
	browser.find_element_by_link_text(lista1[i]).click()
	time.sleep(1)
	browser.find_element_by_xpath('//*[@id="sidebar"]/ul[1]/li[3]/a').click();
	time.sleep(1)
	table2 = browser.find_element_by_xpath('//*[@id="pronosticos_container"]').find_elements_by_tag_name('tr')
	for j in range(0, len(table2)):
		lista3.append(table2[j].find_elements_by_tag_name("td")[0].text.encode('utf-8'))
		lista4.append(table2[j].find_elements_by_tag_name("td")[1].text.encode('utf-8'))
		row = lista1[i] + "," + lista2[i] + "," + lista3[j] + "," + lista4[j] + "\n"
		csv.write(row)
		
	browser.back()
	browser.back()
	browser.refresh()
	time.sleep(1)

time.sleep(5)

csv.close()
browser.quit()


	
	
