/// <reference types="Cypress" />

describe('homepage', function(){
    it('go to CRM', function(){
        cy.visit("localhost/login.php")
        cy.get('#username')
          .type('paul').should('have.value', 'paul')
        cy.get('#password')
          .type('paul').should('have.value', 'paul')
          cy.get('#submit').click()
		    cy.get(':nth-child(4) > [width="16%"] > a').click();
        ///assert invoeren
    })
})
