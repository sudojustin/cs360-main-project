# BarterDB Project Requirements

## Project Description
Design an anonymous barter database for two pairs of people to exchange goods of interest anonymously.

### Process Overview
- Person X wants to sell product P, and person A wants to buy it in exchange for product/service E
- Person X wants product E instead of money for product P
- Person A doesn't have product E, but their partner B has it
- Person X's partner Y may need product E
- The barter arranges exchanges between B and Y, and X and A
- Values of products P and E must be equivalent according to equivalence table T
- The transaction must maintain anonymity between parties
- Transaction costs must be accounted for in the value calculation:
  - Transfer of P to A costs c'%
  - Transfer of E to Y costs c"%

### Exchange Process
1. All parties have accounts in the Barter database
2. X posts anonymously on a bulletin board offering item P in exchange for E, mentioning partner Y
3. A posts needing P in exchange for E
4. Parties may list quantity and whether they're willing to split the trade
5. After a match is established, a 16-digit hash code is generated
6. First half of code sent to A, second half to Y
7. X sends P to database with the hash key
8. Database requests B to send E with 8-digit code received from A
9. Once B sends E to database, Y is requested to send their 8-digit code
10. If concatenated code is valid, database sends P to A and E to Y
11. Transaction costs are applied to both sides

## Deliverables

1. **Database Design**
   - Third-normal form database to store all required information

2. **User Authentication**
   - Password-protected account system
   - Personal details storage (phone, address, email)

3. **Trade Interface**
   - Accessible only to valid users
   - Functionality to post items and request trades

4. **User Dashboard**
   - View posted items for trade
   - Track active transactions
   - View completed exchanges

5. **Admin Dashboard: Account Management**
   - Manage user accounts
   - Approve accounts
   - Suspend accounts
   - Delete accounts

6. **Admin Dashboard: Transaction Management**
   - View all transactions
   - Sort by column values
   - Show transaction details (number, items, parties, dates, hash key)
   - Display transaction costs (cumulative and individual) 