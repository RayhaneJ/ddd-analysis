using Microsoft.EntityFrameworkCore;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using Wellcome.API.Helpers;
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

        public async Task<FileUploadResult> UploadImage(UploadForm form, string userUuid)
        {
            var fileName = await FileUploadHelper.UploadFile(form);
            var user = await ctx.Users.SingleOrDefaultAsync(u => u.Uuid == userUuid);
            
            var profilePicture = await ctx.ProfilePictures.SingleOrDefaultAsync(p => p.UserId == user.ID);
            profilePicture.Path = Path.Combine("/Images/", fileName);
            await ctx.SaveChangesAsync();
            
            return new FileUploadResult { FileName = fileName };
        }

        public async Task UpdateAccount(AccountDto account, string userUuid)
        {
            var user = await ctx.Users
                .Include(u => u.Contact)
                .SingleOrDefaultAsync(u => u.Uuid == userUuid);

            user.Contact.FirstName = account.FirstName;
            user.Contact.LastName = account.LastName;
            user.Contact.Phone = account.Phone; 
            user.Contact.Mail = account.Email;
            user.Gender = (Gender)Enum.Parse(typeof(Gender), account.Gender);

            await ctx.SaveChangesAsync();
        }

        public async Task UpdateProfile(ProfileDto profile, string userUuid)
        {
            var user = await ctx.Users
                .Include(u => u.Contact)
                .SingleOrDefaultAsync(u => u.Uuid == userUuid);

            user.Profession = profile.Profession;
            user.Description = profile.AboutMe;
            user.Languages = profile.Languages.ToArray();

            await ctx.SaveChangesAsync();
        }
    }
}
