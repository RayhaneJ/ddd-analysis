using Microsoft.EntityFrameworkCore;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using Wellcome.Database;
using Wellcome.DataModel;

namespace Wellcome.API
{
    public class AccountService
    {
        private readonly WellcomeContext ctx;

        public AccountService(WellcomeContext context)
        {
            ctx = context;
        }

        public async Task RegisterAccount(AccountDto account)
        {
            using var transaction = ctx.Database.BeginTransaction();

            var contact = new Contact()
            {
                FirstName = account.FirstName,
                LastName = account.LastName,
                Mail = account.Email
            };

            ctx.Contacts.Add(contact);
            await ctx.SaveChangesAsync();

            var user = new User
            {
                BirthDate = DateTime.Parse(account.BirthDate),
                ContactId = contact.ID,
                Password = account.Password
            };
            ctx.Users.Add(user);
            await ctx.SaveChangesAsync();

            transaction.Commit();
        }

        public async Task<AccountDto> LogIn(AccountDto account)
        {
            var user = await ctx.Users
                .Include(u => u.Contact)
                .Where(u => u.Contact.Mail == account.Email && u.Password == account.Password)
                .SingleOrDefaultAsync();

            return new AccountDto
            {
                BirthDate = user.BirthDate.ToString(),
                Email = user.Contact.Mail,
                FirstName = user.Contact.FirstName,
                LastName = user.Contact.LastName,
                Phone = user.Contact.Phone
            };
        }
    }
}
