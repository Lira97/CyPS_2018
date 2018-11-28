# encoding: utf-8
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver import ActionChains
import time
import random

browser = webdriver.Firefox()

browser.get('http://localhost:8080/')

def create_employees(employees):

    browser.find_element_by_xpath('/html/body/div/div/nav/ul/li[3]/a').click()

    time.sleep(2)

    for emp in employees:
        print(emp)
        val = random.randint(1, 2)
        sueldo = random.randint(81, 1500)
        browser.find_element_by_xpath('/html/body/div/div/nav/ul/li[1]/div/button').click()
        browser.find_element_by_xpath('//*[@id="nombre"]').clear()
        browser.find_element_by_xpath('//*[@id="nombre"]').send_keys(emp)
        browser.find_element_by_xpath('/html/body/div[1]/div/div[1]/div/div/div[2]/form/select/option['+str(val)+']').click()
        browser.find_element_by_xpath('//*[@id="sueldo"]').clear()
        browser.find_element_by_xpath('//*[@id="sueldo"]').send_keys(str(sueldo))
        browser.find_element_by_xpath('//*[@id="act"]').click()
        browser.find_element_by_xpath('/html/body/div[1]/div/div[1]/div/div/div[3]/button['+str(val)+']').click()
        if val == 2:
            time.sleep(2)
            browser.switch_to_alert().accept()
        print(val)
        time.sleep(1)


def delete_employee(num):
    browser.find_element_by_xpath('/html/body/div/div/nav/ul/li[3]/a').click()

    time.sleep(2)

    browser.find_element_by_xpath('//*[@id="'+str(num)+'"]').click()


def add_table(tables):
    
    browser.find_element_by_xpath('/html/body/div/div/nav/ul/li[2]/a').click()

    for t in tables:
        browser.find_element_by_xpath('/html/body/div/div/nav/ul/li[1]/div/button').click()
        browser.find_element_by_xpath('//*[@id="capacidad"]').clear()
        browser.find_element_by_xpath('//*[@id="capacidad"]').send_keys(str(t))
        browser.find_element_by_xpath('//*[@id="addTableButton"]').click()
        time.sleep(1)
        browser.switch_to_alert().accept()
        time.sleep(3)


def delete_table(num):
    browser.find_element_by_xpath('//*[@id="'+str(num)+'"]').click()
    time.sleep(1)
    browser.switch_to_alert().accept()


def asign_table():
    tables = browser.find_elements_by_name('assignModal')
    browser.find_element_by_xpath('//*[@id="assignTable"]').click()
    time.sleep(1)
    browser.find_element_by_xpath('//*[@id="clientName"]').clear()
    browser.find_element_by_xpath('//*[@id="clientName"]').send_keys('Aaron Zajac')
    browser.find_element_by_xpath('//*[@id="empleadosSelect"]').click()
    browser.find_element_by_xpath('/html/body/div[1]/div/div[2]/div/div/div[2]/form/select/option[1]').click()
    browser.find_element_by_xpath('/html/body/div[1]/div/div[2]/div/div/div[3]/button[2]').click()
    time.sleep(1)
    browser.switch_to_alert().accept()
    time.sleep(3)
        

def add_product(prods):
    browser.find_element_by_xpath('/html/body/div/div/nav/ul/li[5]/a/span').click()
    val = random.randint(90, 150)
    for p in prods:
        browser.find_element_by_xpath('/html/body/div/div/nav/ul/li[1]/div/button').click()
        browser.find_element_by_xpath('//*[@id="nombreDelProducto"]').clear()
        browser.find_element_by_xpath('//*[@id="nombreDelProducto"]').send_keys(str(p))
        browser.find_element_by_xpath('//*[@id="costoDelProducto"]').clear()
        browser.find_element_by_xpath('//*[@id="costoDelProducto"]').send_keys(str(val))
        browser.find_element_by_xpath('//*[@id="precioDelProducto"]').clear()
        browser.find_element_by_xpath('//*[@id="precioDelProducto"]').send_keys(str(val+20))
        tipo = browser.find_element_by_name('tipoSelect')
        opt = tipo.find_elements_by_tag_name('option')
        for option in opt:
            if option.get_attribute('value') == "PlatoFuerte":
                option.click()
        browser.find_element_by_xpath('/html/body/div[1]/div/div[1]/div/div/div[3]/button[2]').click()
        time.sleep(1)
        browser.switch_to_alert().accept()
        time.sleep(3)


def add_account():
    browser.find_element_by_xpath('/html/body/div/div/nav/ul/li[4]/a').click()
    val = random.randint(1, 3)
    browser.find_element_by_name('orderModal').click()
    time.sleep(1)
    browser.find_element_by_xpath('//*[@id="productSelect"]').click()
    browser.find_element_by_xpath('/html/body/div[1]/div/div[1]/div/div/div[2]/form/select/option['+str(val)+']').click()
    browser.find_element_by_xpath('/html/body/div[1]/div/div[1]/div/div/div[3]/button[2]').click()
    time.sleep(1)
    browser.switch_to_alert().accept()

    
def entrega_orden():
    browser.find_element_by_xpath('/html/body/div/div/nav/ul/li[6]/a').click()
    body = browser.find_element_by_tag_name('tbody')
    orders = body.find_elements_by_tag_name('tr')
    print(orders)
    for order in range(0, len(orders)-1):
        print(order)
        time.sleep(2)
        if order == 0:
            browser.find_element_by_xpath('/html/body/div/div/div[2]/div[1]/div/div[1]/div/div/div/table/tbody/tr/td[5]/button[2]').click()
            time.sleep(2)
            browser.switch_to_alert().accept()
        else:
            browser.find_element_by_xpath('/html/body/div/div/div[2]/div[1]/div/div[1]/div/div/div/table/tbody/tr['+str(order)+']/td[5]/button[2]').click()
            time.sleep(2)
            browser.switch_to_alert().accept()


def cancel_ordrer():
    browser.find_element_by_xpath('/html/body/div/div/nav/ul/li[6]/a').click()
    browser.find_element_by_xpath('/html/body/div/div/div[2]/div[1]/div/div[1]/div/div/div/table/tbody/tr/td[5]/button[1]').click()
    time.sleep(2)
    browser.switch_to_alert().accept()


def pay_account():

    browser.find_element_by_xpath('/html/body/div/div/nav/ul/li[4]/a').click()
    time.sleep(2)
    browser.find_element_by_name('pay').click()
    time.sleep(2)
    browser.switch_to_alert().accept()


employees = ['Aaron Zajac', 'Emiliano Abascal', 'Semy Levy']
productos = ['Camote', 'Pepino', 'Zanahoria']
tables = [1, 2]
# create_employees(employees)
# delete_employee(6)
# add_table(tables)
# delete_table(22)
# asign_table()
# add_product(productos)
# time.sleep(2)
# add_account()
# entrega_orden()
time.sleep(2)
pay_account()
#cancel_ordrer()

# browser.quit()