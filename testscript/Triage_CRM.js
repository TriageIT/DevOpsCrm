/// <reference types="Cypress" />

describe('homepage', function(){
    it('go to CRM', function(){
        cy.visit("localhost/login.php")
        cy.get('#username')
          .type('paul').should('have.value', 'paul')
        cy.get('#password')
          .type('paul').should('have.value', 'paul')
          cy.get('#submit').click()  
    })
})