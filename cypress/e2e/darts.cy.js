describe('Darts', () => {
  it('successfully loads', () => {
    cy.visit('/')
    cy.get("main > h2").contains("Liste des tournois")
  })

  it('loads preferred tournament', () => {
    cy.setCookie('gameId', '1')
    cy.visit('/')
    cy.url().should('include', '/1')
  })
})