from selenium import webdriver
from selenium.webdriver.common.keys import Keys


browser = webdriver.Chrome()
browser.get("http://blazedemo.com/")

element = browser.find_element_by_name("fromPort")
opciones = element.find_elements_by_tag_name("option")
 
for opcion in opciones:
    if opcion.get_attribute("value") == "Mexico City":
        opcion.click()


element2 = browser.find_element_by_name("toPort")
opciones2 = element2.find_elements_by_tag_name("option")

for opcion in opciones:
    if opcion.get_attribute("value") == "Buenos Aires":
        opcion.click()

boton = browser.find_element_by_xpath("//input")
boton.click()

tabla = browser.find_element_by_class_name("table")

vuelos = tabla.find_elements_by_xpath("//tr")
print ("vuelos: %d" % len(vuelos))

preciosGlobal = []

for vuelo in vuelos: 

    precios = vuelo.find_elements_by_name("price")

    for precio in precios:
        preciosGlobal.append(precio.get_attribute("value"))
    

minimo = min(preciosGlobal)

print(minimo)

for v in vuelos: 

    precios = v.find_elements_by_name("price")

    for precio in precios:

        if precio.get_attribute("value") == minimo:

            print("lo encontre")
            

browser.close()